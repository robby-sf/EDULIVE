let video, canvas, ctx;
let isStudying = false;
let studyStartTime, studyEndTime;
let focusDuration = 0;
let distractionDuration = 0;
let currentDistraction = null;
let distractions = {};
let poseStatus = "Fokus ✅";
let objectStatus = "Tidak terdeteksi";
let poseLoopId = null;
let objectLoopId = null;
let lastFocusTimes = null;
let lastDistractionTime = null;
let distractionStartTime = null;
let focusStartTime = null;
let lastAudioPlayedAt = {};


const warningAudio = new Audio('/sounds/warning.mp3');

const LABELS = {
    "fokus": "Fokus ✅",
    "tiduran": "Tiduran 🛌",
    "menunduk": "Menunduk 📱",
    "keluar frame": "Keluar Frame ❌",
    "cell phone": "Main HP 📱"
};

const audioMap = {
    "tiduran": new Audio('/sounds/Jangan Tidur.mp3'),
    "menunduk": new Audio('/sounds/Menunduk.mp3'),
    "keluar frame": new Audio('/sounds/Kamu mau kemana.mp3'),
    "cell phone": new Audio('/sounds/Jangan Main Hp.mp3'),
    "drink": new Audio('/sounds/Minum.m4a')
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

function playDistractionAudio(type) {
    const now = getNow();

    const cooldown = 5 * 1000;
    if (lastAudioPlayedAt[type] && now - lastAudioPlayedAt[type] < cooldown) {
        return;
    }

    lastAudioPlayedAt[type] = now;

    const audio = audioMap[type];
    if (audio) {
        audio.play().catch(e => console.warn("⚠️ Gagal play audio:", e));
    }
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
    const objectResult = await detectObjects(video, ctx);
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
        if (distractionStartTime && currentDistraction) {
            const diff = seconds(now - distractionStartTime);
            distractions[currentDistraction] = (distractions[currentDistraction] || 0) + diff;
            distractionDuration += diff;
        }

        currentDistraction = type;
        distractionStartTime = now;

        if (focusStartTime) {
            const focusDiff = seconds(now - focusStartTime);
            focusDuration += focusDiff;
            distractions["fokus"] = (distractions["fokus"] || 0) + focusDiff;
            focusStartTime = null;
        }
        playDistractionAudio(type);
    }
}


function handleFocus() {
    const now = getNow();

    if (currentDistraction !== null) {
        if (distractionStartTime) {
            const diff = seconds(now - distractionStartTime);
            distractions[currentDistraction] = (distractions[currentDistraction] || 0) + diff;
            distractionDuration += diff;
        }

        currentDistraction = null;
        distractionStartTime = null;
    }

    if (!focusStartTime) {
        focusStartTime = now;
    }
}

// ===== Session Control =====
async function startSession() {
    isStudying = true;
    studyStartTime = new Date();
    await tf.setBackend('webgl');
    await tf.ready();
    // console.log('✅ Backend WebGL siap!');

    await setupPoseDetection(video, canvas, ctx);
    await setupObjectDetection();

    // console.log("🧠 Semua model siap. Mulai belajar...");

    loop();

    setInterval(() => {
        playDistractionAudio("drink");
    }, 10 * 60 * 1000); //debug ke 1 menit
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
    const now = getNow();

    if (currentDistraction && distractionStartTime) {
        const diff = seconds(now - distractionStartTime);
        distractions[currentDistraction] = (distractions[currentDistraction] || 0) + diff;
        distractionDuration += diff;
    }

    if (focusStartTime) {
        const diff = seconds(now - focusStartTime);
        // distractions["fokus"] = (distractions["fokus"] || 0) + diff;
        focusDuration += diff;
    }

    const payload = {
        started_at: studyStartTime.toISOString(),
        ended_at: studyEndTime.toISOString(),
        focus_duration: focusDuration, 
        distraction_duration: distractionDuration, 
        distraction_log: JSON.stringify(distractions), 
    };

    // console.log("Total Fokus:", focusDuration, "detik");
    // console.log("Total Gangguan:", distractionDuration, "detik");
    // console.log("Rincian Gangguan:", distractions);

    console.log("Data sesi belajar:", payload);

        fetch('/study-session', {
            method: 'POST',
            credentials: 'same-origin', 
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(payload)
        })
        .then(async res => {
            const text = await res.text();
            console.log("📨 Server Response:", text);

            try {
                const json = JSON.parse(text);
                // console.log("✅ Parsed JSON:", json);
            } catch (e) {
                // console.error("❌ Bukan JSON:", e);
            }
        })
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

    // ✔ Improve logika "menunduk"
    const headLeaningDown = nose.y - avgShoulderY > 20;
    const isMenunduk = headLeaningDown && !shouldersFlat && nose.score > 0.3;

    // ✔ Improve logika "tiduran"
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
