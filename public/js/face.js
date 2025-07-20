// face.js
console.log("✅ Memulai load face-api.js...");

window.setupFaceDetection = async function () {
    try {
        await faceapi.nets.tinyFaceDetector.loadFromUri('/models/tiny_face_detector');
        await faceapi.nets.faceLandmark68Net.loadFromUri('/models/face_landmark_68');
        await faceapi.nets.faceExpressionNet.loadFromUri('/models/face_expression');
        console.log("✅ Face detection siap");
    } catch (err) {
        console.error("❌ Gagal memuat model face-api.js:", err);
    }
};

window.detectFaces = async function (video, canvas, ctx, playWarning) {
    try {
        const detections = await faceapi
            .detectAllFaces(video, new faceapi.TinyFaceDetectorOptions())
            .withFaceLandmarks()
            .withFaceExpressions();

        // Kosongkan canvas dulu
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        // Gambar deteksi wajah & landmark
        faceapi.draw.drawDetections(canvas, detections);
        faceapi.draw.drawFaceLandmarks(canvas, detections);

        // Deteksi ekspresi
        for (let d of detections) {
            const exp = d.expressions;
            const topEmotion = Object.keys(exp).reduce((a, b) => exp[a] > exp[b] ? a : b);
            if (topEmotion === "sad") {
                playWarning("Semangat ya! Jangan sedih.");
            }
        }
    } catch (err) {
        console.error("❌ Gagal mendeteksi wajah:", err);
    }
};
