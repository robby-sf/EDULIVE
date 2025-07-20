

let video, canvas, ctx;
let isStudying = false;
let studyStartTime, studyEndTime;
let focusDuration = 0;
let distractionDuration = 0;
let currentDistraction = null;
let distractions = {}; // Contoh: { "cell phone": 120, "tiduran": 60 }

let lastFocusTime = null;
let lastDistractionTime = null;

const warningAudio = new Audio('/sounds/warning.mp3');

// ===== Utils =====

function getNow() {
    return new Date().getTime();
}

function seconds(ms) {
    return Math.floor(ms / 1000);
}

function playWarning(text) {
    console.log("⚠️ Warning:", text);
    warningAudio.play();

    const utterance = new SpeechSynthesisUtterance(text);
    speechSynthesis.speak(utterance);
}

// ===== Deteksi Utama =====

async function detectAll() {
    let focus = true;

    const poseResult = await detectPose(video, ctx);
    if (poseResult === "tiduran") {
        focus = false;
        handleDistraction("tiduran");
    }

    const faceResult = await detectFace(video, ctx);
    if (faceResult === "hilang") {
        focus = false;
        handleDistraction("wajah tidak terdeteksi");
    }

    const objectResult = await detectObjects(video, ctx, playWarning);
    if (objectResult.includes("cell phone")) {
        focus = false;
        handleDistraction("cell phone");
    }

    if (focus) handleFocus();
}

function handleDistraction(type) {
    const now = getNow();

    if (currentDistraction !== type) {
        currentDistraction = type;
        lastDistractionTime = now;
    }

    const diff = seconds(now - lastDistractionTime);
    distractions[type] = (distractions[type] || 0) + diff;
    distractionDuration += diff;

    lastDistractionTime = now;
}

function handleFocus() {
    const now = getNow();

    if (currentDistraction !== null) {
        currentDistraction = null;
        lastFocusTime = now;
    }

    if (lastFocusTime) {
        const diff = seconds(now - lastFocusTime);
        focusDuration += diff;
    }

    lastFocusTime = now;
}

// ===== Session Control =====

async function startSession() {
    isStudying = true;
    studyStartTime = new Date();

    await setupPoseDetection(video, canvas, ctx);
    await setupFaceDetection();
    await setupObjectDetection();

    console.log("🧠 Semua model siap. Mulai belajar...");

    loop();
}

function loop() {
    if (!isStudying) return;
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
    detectAll();
    requestAnimationFrame(loop);
}

function stopSession() {
    isStudying = false;
    studyEndTime = new Date();

    const totalDuration = seconds(studyEndTime - studyStartTime);

    const payload = {
        started_at: studyStartTime.toISOString(),
        ended_at: studyEndTime.toISOString(),
        total_duration: totalDuration,
        focus_duration: focusDuration,
        distraction_duration: distractionDuration,
        distractions: distractions
    };

    console.log("📊 Data sesi belajar:", payload);

    fetch('/api/sessions', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify(payload)
    })
    .then(res => res.json())
    .then(data => console.log("✅ Data terkirim ke server:", data))
    .catch(err => console.error("❌ Gagal kirim data:", err));
}

// Deteksi satu frame postur, return status
window.detectPose = async function(video, ctx) {
    if (!detector) return "unknown";

    const poses = await detector.estimatePoses(video);
    if (poses.length === 0) return "tidak terdeteksi";

    const keypoints = poses[0].keypoints;
    const get = (name) => keypoints.find(p => p.name === name);
    const nose = get('nose');
    const leftShoulder = get('left_shoulder');
    const rightShoulder = get('right_shoulder');
    const leftEar = get('left_ear');
    const rightEar = get('right_ear');

    const allVisible = [nose, leftShoulder, rightShoulder].every(p => p && p.score > 0.3);

    if (!allVisible) return "keluar frame";

    const avgShoulderY = (leftShoulder.y + rightShoulder.y) / 2;
    const headBelowShoulders = nose.y - avgShoulderY > 60;

    const earAligned = leftEar && rightEar &&
        leftEar.score > 0.3 && rightEar.score > 0.3 &&
        Math.abs(leftEar.y - rightEar.y) < 15;

    const shouldersFlat = Math.abs(leftShoulder.y - rightShoulder.y) < 15;

    if (headBelowShoulders) return "menunduk";
    if (earAligned && shouldersFlat) return "tiduran";
    return "fokus";
};


// ===== Init Saat Halaman Siap =====

window.onload = () => {
    video = document.getElementById('video');
    canvas = document.getElementById('output');
    ctx = canvas.getContext('2d');

    video.oncanplay = async () => {
    // Pastikan video benar-benar siap
    if (video.readyState >= 2) {
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;

        await startSession();

        // Optional: stop otomatis setelah 1 jam
        setTimeout(stopSession, 60 * 60 * 1000);
    } else {
        console.warn("⚠️ Video belum siap diputar.");
    }
};

};
