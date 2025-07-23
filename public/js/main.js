let video, canvas, ctx;
let isStudying = false;
let studyStartTime, studyEndTime;
let focusDuration = 0;
let distractionDuration = 0;
let currentDistraction = null;
let distractions = {}; // Contoh: { "cell phone": 120, "tiduran": 60 }
let poseStatus = "Fokus ✅";
let objectStatus = "Tidak terdeteksi";
let poseLoopId = null;
let objectLoopId = null;
let lastFocusTimes = null;
let lastDistractionTime = null;

const warningAudio = new Audio('/sounds/warning.mp3');

const LABELS = {
    "fokus": "Fokus ✅",
    "tiduran": "Tiduran 🛌",
    "menunduk": "Menunduk 📱",
    "keluar frame": "Keluar Frame ❌",
    "cell phone": "Main HP 📱"
};

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
    if (poseResult === "tiduran" || poseResult === "menunduk" || poseResult === "keluar frame") {
        poseStatus = poseResult === "tiduran" ? "Tiduran 🛌" : poseResult === "menunduk" ? "Menunduk 📱" : "Keluar Frame ❌";
        window.onPoseStatusUpdate(poseStatus);
        focus = false;
        handleDistraction(poseResult);
    } else {
        poseStatus = "Fokus ✅";
        window.onPoseStatusUpdate(poseStatus);
    }

    // Simpan hasil object detection
    const objectResult = await detectObjects(video, ctx, playWarning);
    if (objectResult === "cell phone") {
        objectStatus = "cell phone";
        focus = false;
        handleDistraction("cell phone");
    } else {
        objectStatus = "Tidak terdeteksi";
    }

    // Trigger update status gabungan
    window.onObjectDetected(objectStatus);

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
        lastFocusTimes = now;
    }

    if (lastFocusTimes) {
        const diff = seconds(now - lastFocusTimes);
        focusDuration += diff;
        distractions["fokus"] = (distractions["fokus"] || 0) + diff; // ✅ Tambah ini
    }

    lastFocusTimes = now;
}

// ===== Session Control =====



async function startSession() {
    isStudying = true;
    studyStartTime = new Date();
    await tf.setBackend('webgl');
    await tf.ready();
    console.log('✅ Backend WebGL siap!');

    await setupPoseDetection(video, canvas, ctx);
    await setupObjectDetection();

    console.log("🧠 Semua model siap. Mulai belajar...");

    loop();
}

function loop() {
    if (!isStudying) return;
    if (video.paused || video.ended || video.readyState < 2) return; 

    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
    detectAll();
    requestAnimationFrame(loop);
}
function stopSession() {
    isStudying = false;
    studyEndTime = new Date();

    if (video && video.srcObject) {
        video.srcObject.getTracks().forEach(track => track.stop());
        video.srcObject = null;
    }

    const canvas = document.getElementById("canvas");
    const ctx = canvas?.getContext("2d");
    ctx?.clearRect(0, 0, canvas.width, canvas.height);

    const totalDuration = seconds(studyEndTime - studyStartTime);

    const readableDistractions = {};
    for (const key in distractions) {
        const label = LABELS[key] || key;
        readableDistractions[label] = distractions[key];
    }

    const payload = {
        started_at: studyStartTime.toISOString(),
        ended_at: studyEndTime.toISOString(),
        total_duration: seconds(studyEndTime - studyStartTime),
        focus_duration: focusDuration,
        distraction_duration: distractionDuration,
        distraction_log: readableDistractions
    };

    console.log("📊 Data sesi belajar:", payload);

    fetch('/api/study-session', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify(payload)
    })
    .then(async res => {
    const data = await res.json();
    if (!res.ok) {
        throw new Error(`HTTP ${res.status}: ${JSON.stringify(data)}`);
    }
    console.log("✅ Data terkirim ke server:", data);
    })
    .catch(err => console.error("❌ Gagal kirim data:", err))
    .then(res => res.json())
    .then(data => console.log("✅ Data terkirim ke server:", data))
    .catch(err => console.error("❌ Gagal kirim data:", err));
}

// ====== Deteksi Pose Satu Frame ======
window.detectPose = async function(video, ctx) {
    if (!detector) return "unknown";

    const poses = await detector.estimatePoses(video);
    if (poses.length === 0) return "keluar frame";

    const keypoints = poses[0].keypoints;
    const get = (name) => keypoints.find(p => p.name === name);

    const nose = get('nose');
    const leftShoulder = get('left_shoulder');
    const rightShoulder = get('right_shoulder');
    const leftEar = get('left_ear');
    const rightEar = get('right_ear');
    const leftHip = get('left_hip');
    const rightHip = get('right_hip');

    const keypointsNeeded = [nose, leftShoulder, rightShoulder, leftHip, rightHip];
    const visibleCount = keypointsNeeded.filter(p => p && p.score > 0.3).length;
    if (visibleCount < 3) return "keluar frame";

    const avgShoulderY = (leftShoulder.y + rightShoulder.y) / 2;
    const avgHipY = (leftHip.y + rightHip.y) / 2;

    const shouldersFlat = Math.abs(leftShoulder.y - rightShoulder.y) < 15;

    // ✔️ Improve logika "menunduk"
    const headLeaningDown = nose.y - avgShoulderY > 20;
    const isMenunduk = headLeaningDown && !shouldersFlat && nose.score > 0.3;

    // ✔️ Improve logika "tiduran"
    const shouldersHorizontal = Math.abs(leftShoulder.y - rightShoulder.y) < 10;
    const hipsHorizontal = Math.abs(leftHip.y - rightHip.y) < 10;
    const shouldersDistance = Math.abs(leftShoulder.x - rightShoulder.x);
    const hipsDistance = Math.abs(leftHip.x - rightHip.x);
    const torsoAngle = Math.abs(avgShoulderY - avgHipY);
    const isLying = shouldersHorizontal && hipsHorizontal &&
                    shouldersDistance > 100 && hipsDistance > 100 &&
                    torsoAngle < 50;

    if (isLying) return "tiduran";
    if (isMenunduk) return "menunduk";

    return "fokus";
};

// ===== Init Saat Halaman Siap =====
window.onload = async () => {
    video = document.getElementById('video');
    canvas = document.getElementById('output');
    ctx = canvas.getContext('2d');

    video.oncanplay = async () => {
        if (video.readyState >= 2) {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;

            await startSession(); 

            setTimeout(() => {
                console.log("🎯 Mulai loop deteksi setelah semua siap");
                requestAnimationFrame(loopDeteksi);
            }, 500); 

            setTimeout(stopSession, 60 * 60 * 1000);
        } else {
            console.warn("⚠️ Video belum siap diputar.");
        }
    };
};

async function loopDeteksi() {
    if (!video || !ctx || video.paused || video.ended) return;
    
    // Gunakan detectAll untuk menangani semua deteksi
    await detectAll();
    requestAnimationFrame(loopDeteksi);
}


function updateCombinedStatus() {
    let finalStatus = "fokus";

    if (poseStatus !== "Fokus ✅") {
        finalStatus = poseStatus;
    } else if (objectStatus === "cell phone") {
        finalStatus = "cell phone";
    }

    const displayLabel = LABELS[finalStatus] || finalStatus;

    document.getElementById('statusBelajar').textContent = displayLabel;
    document.getElementById('statusBelajar').className =
        finalStatus === "fokus"
            ? "text-2xl font-bold text-green-600"
            : "text-2xl font-bold text-red-600";

    window.updateDebugStatus?.({
        pose: poseStatus,
        object: objectStatus
    });
}

window.onPoseStatusUpdate = (status) => {
    poseStatus = status;
    updateCombinedStatus();
};

window.onObjectDetected = (status) => {
    objectStatus = status;
    updateCombinedStatus();
};
