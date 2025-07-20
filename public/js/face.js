console.log("✅ Memulai load face-api.js...");

let lastFaceStatus = "Netral 🙂";
let lastFaceTime = Date.now();

window.setupFaceDetection = async function () {
    try {
        await faceapi.nets.tinyFaceDetector.loadFromUri('/models/tiny_face_detector');
        await faceapi.nets.faceLandmark68Net.loadFromUri('/models/face_landmark_68');
        await faceapi.nets.faceExpressionNet.loadFromUri('/models/face_expression');
        console.log("✅ Face detection siap");
    } catch (err) {
        console.error("❌ Gagal load face-api model:", err);
    }
};

window.detectFace = async function (video, canvas, ctx, playWarning) {
    try {
        const detections = await faceapi
            .detectAllFaces(video, new faceapi.TinyFaceDetectorOptions())
            .withFaceLandmarks()
            .withFaceExpressions();

        ctx.clearRect(0, 0, canvas.width, canvas.height);

        faceapi.draw.drawDetections(canvas, detections);
        faceapi.draw.drawFaceLandmarks(canvas, detections);

        let now = Date.now();
        let newStatus = "Netral 🙂";
        let hasFace = detections.length > 0;

        if (hasFace) {
            const exp = detections[0].expressions;
            const topEmotion = Object.keys(exp).reduce((a, b) => exp[a] > exp[b] ? a : b);

            if (topEmotion === "happy") {
                newStatus = "Bahagia 😄";
            } else if (topEmotion === "sad") {
                newStatus = "Sedih 😢";
            } else if (["angry", "fearful", "disgusted", "surprised"].includes(topEmotion)) {
                newStatus = "Mengantuk/Mati Fokus 😴";
            }

            if (topEmotion === "sad") {
                playWarning("Semangat ya! Jangan sedih.");
            }
        } else {
            newStatus = "Tidak Terlihat ❌";
        }

        // 2 detik delay ganti status
        if (newStatus !== lastFaceStatus && (now - lastFaceTime >= 2000)) {
            lastFaceStatus = newStatus;
            lastFaceTime = now;
            updateFaceStatus(newStatus); // Fungsi update UI
        }

    } catch (err) {
        console.error("❌ Gagal mendeteksi wajah:", err);
    }
};

function updateFaceStatus(status) {
    const el = document.getElementById('statusEkspresi');
    if (!el) return;

    el.textContent = status;

    if (status.includes("Bahagia")) {
        el.className = "text-xl font-semibold text-green-500";
    } else if (status.includes("Sedih") || status.includes("Mengantuk")) {
        el.className = "text-xl font-semibold text-yellow-600";
    } else if (status.includes("Tidak Terlihat")) {
        el.className = "text-xl font-semibold text-red-600";
    } else {
        el.className = "text-xl font-semibold text-gray-600";
    }
}

window.onFaceEmotionUpdate?.(newStatus);
