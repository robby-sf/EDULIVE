import * as faceapi from 'face-api.js';

async function setupFaceDetection() {
    await faceapi.nets.tinyFaceDetector.loadFromUri('/models');
    await faceapi.nets.faceLandmark68Net.loadFromUri('/models');
    await faceapi.nets.faceExpressionNet.loadFromUri('/models'); // untuk emosi
    console.log("✅ Face detection siap");
}

async function detectFaces() {
    const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions())
        .withFaceLandmarks()
        .withFaceExpressions();

    faceapi.draw.drawDetections(canvas, detections);
    faceapi.draw.drawFaceLandmarks(canvas, detections);

    for (let d of detections) {
        const exp = d.expressions;
        const topEmotion = Object.keys(exp).reduce((a, b) => exp[a] > exp[b] ? a : b);
        if (topEmotion === "sad") {
            playWarning("Semangat ya! Jangan sedih.");
        }
    }
}

async function monitorLoop() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    await detectPose();         // dari BlazePose
    await detectObjects();      // dari coco-ssd
    await detectFaces();        // dari face-api.js

    requestAnimationFrame(monitorLoop);
}

    const video = document.getElementById('video');

    // Mulai kamera
    async function startVideo() {
        try {
            const stream = await navigator.mediaDevices.getUserMedia({ video: {} });
            video.srcObject = stream;
        } catch (err) {
            console.error("Kamera tidak bisa diakses:", err);
        }
    }

    // Deteksi wajah
    async function onPlay() {
        const canvas = document.getElementById('overlay');
        const displaySize = { width: video.width, height: video.height };
        faceapi.matchDimensions(canvas, displaySize);

        setInterval(async () => {
            const detections = await faceapi
                .detectAllFaces(video)
                .withFaceLandmarks()
                .withFaceDescriptors();

            const resizedDetections = faceapi.resizeResults(detections, displaySize);
            canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
            faceapi.draw.drawDetections(canvas, resizedDetections);
            faceapi.draw.drawFaceLandmarks(canvas, resizedDetections);
        }, 300); // tiap 300ms
    }

    // Load model dan jalankan
    Promise.all([
        faceapi.nets.ssdMobilenetv1.loadFromUri('/models'),
        faceapi.nets.faceLandmark68Net.loadFromUri('/models'),
        faceapi.nets.faceRecognitionNet.loadFromUri('/models')
    ]).then(startVideo);

    video.addEventListener('play', onPlay);
