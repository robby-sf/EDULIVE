// Variabel global
let detector;
let lastFocusTime = Date.now();
let lastStatus = "Fokus ✅";
let isPoseActive = true;
let lastStatusChangeTime = Date.now();
const statusChangeCooldown = 1000; // minimal 1 detik antara perubahan status

console.log("Pose berhasil dimuat");

const BLAZEPOSE_KEYPOINT_NAMES = [
  "nose", "left_eye", "right_eye", "left_ear", "right_ear",
  "left_shoulder", "right_shoulder", "left_elbow", "right_elbow",
  "left_wrist", "right_wrist", "left_hip", "right_hip",
  "left_knee", "right_knee", "left_ankle", "right_ankle",
  "left_heel", "right_heel", "left_foot_index", "right_foot_index",
  "left_thumb", "left_index", "left_pinky",
  "right_thumb", "right_index", "right_pinky",
  "left_eye_inner", "left_eye_outer",
  "right_eye_inner", "right_eye_outer",
  "left_ear_tragion", "right_ear_tragion",
  "mouth_center"
];

window.setupPoseDetection = async function(video, canvas, ctx) {
    if (tf.getBackend() !== 'webgl') {
        await tf.setBackend('webgl');
    }

    const model = poseDetection.SupportedModels.BlazePose;
    const detectorConfig = {
        runtime: 'mediapipe',
        modelType: 'full',
        solutionPath: 'https://cdn.jsdelivr.net/npm/@mediapipe/pose',
    };
    detector = await poseDetection.createDetector(model, detectorConfig);
    console.log("🔥 BlazePose siap!");

    detectPoseLoop(video, canvas, ctx);
};

function detectPoseLoop(video, canvas, ctx) {
    if (!detector || !isPoseActive || !video?.videoWidth) return;

    detector.estimatePoses(video).then(poses => {
        if (!isPoseActive || !video?.videoWidth) return;

        const now = Date.now();
        let newStatus = "Fokus ✅";

        if (poses.length > 0) {
            const keypoints = poses[0].keypoints;
            const get = (name) => keypoints.find(p => p.name === name);
            const nose = get('nose');
            const leftShoulder = get('left_shoulder');
            const rightShoulder = get('right_shoulder');
            const leftEar = get('left_ear');
            const rightEar = get('right_ear');

            const allVisible = [nose, leftShoulder, rightShoulder].every(p => p && p.score > 0.3);

            if (!allVisible) {
                newStatus = "Keluar Frame ❌";
            } else {
                const avgShoulderY = (leftShoulder.y + rightShoulder.y) / 2;
                const shoulderDiff = Math.abs(leftShoulder.y - rightShoulder.y);
                const earDiff = leftEar && rightEar &&
                    leftEar.score > 0.3 && rightEar.score > 0.3 ?
                    Math.abs(leftEar.y - rightEar.y) : Infinity;

                const headBelowShoulders = nose.y - avgShoulderY > 40;
                const shouldersFlat = shoulderDiff < 12;
                const earsAligned = earDiff < 12;
                const headNearShoulders = Math.abs(nose.y - avgShoulderY) < 25;

                if (headBelowShoulders && !shouldersFlat) {
                    newStatus = "Menunduk 📱";
                } else if (shouldersFlat && earsAligned && headNearShoulders) {
                    newStatus = "Tiduran 🛌";
                } else {
                    newStatus = "Fokus ✅";
                }
            }

            drawKeypoints(keypoints, canvas, ctx);
        } else {
            newStatus = "Keluar Frame ❌";
        }

        const timeSinceLastChange = now - lastStatusChangeTime;

        if (newStatus === "Fokus ✅") {
            lastFocusTime = now;
            if (lastStatus !== "Fokus ✅" && timeSinceLastChange >= statusChangeCooldown) {
                lastStatus = "Fokus ✅";
                lastStatusChangeTime = now;
                updateStatus("Fokus ✅");
            }
        } else {
            const timeOutOfFocus = now - lastFocusTime;
            if (timeOutOfFocus >= 2000 && timeSinceLastChange >= statusChangeCooldown) {
                if (lastStatus !== newStatus) {
                    lastStatus = newStatus;
                    lastStatusChangeTime = now;
                    updateStatus(newStatus);
                }
            } else {
                console.log(`⌛ Belum valid ganti status ke ${newStatus}`);
            }
        }

        window.poseLoopId = requestAnimationFrame(() => detectPoseLoop(video, canvas, ctx));
    }).catch(err => {
        console.warn("❌ Error pose loop:", err);
    });
}


window.stopPoseDetection = function() {
    isPoseActive = false;
    if (window.poseLoopId) {
        cancelAnimationFrame(window.poseLoopId);
        window.poseLoopId = null;
    }
    console.log("🛑 Loop pose detection dihentikan.");
};

function drawKeypoints(keypoints, canvas, ctx) {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    keypoints.forEach((kp, i) => {
        if (kp && kp.score > 0.5) {
            ctx.beginPath();
            ctx.arc(kp.x, kp.y, 5, 0, 2 * Math.PI);
            ctx.fillStyle = 'red';
            ctx.fill();
        }
    });

    ctx.fillStyle = 'blue';
    ctx.font = '20px Arial';
    ctx.fillText('Canvas Aktif 🟢', 10, 30);
    drawSkeleton(keypoints, ctx);
}

function drawSkeleton(keypoints, ctx) {
    const connections = [
        ['left_shoulder', 'right_shoulder'],
        ['left_shoulder', 'left_elbow'],
        ['left_elbow', 'left_wrist'],
        ['right_shoulder', 'right_elbow'],
        ['right_elbow', 'right_wrist'],
        ['left_hip', 'right_hip'],
        ['left_shoulder', 'left_hip'],
        ['right_shoulder', 'right_hip'],
        ['left_hip', 'left_knee'],
        ['left_knee', 'left_ankle'],
        ['right_hip', 'right_knee'],
        ['right_knee', 'right_ankle'],
        ['nose', 'left_eye'],
        ['nose', 'right_eye'],
        ['left_eye', 'left_ear'],
        ['right_eye', 'right_ear'],
        ['left_shoulder', 'left_ear'],
        ['right_shoulder', 'right_ear'],
    ];

    ctx.strokeStyle = 'lime';
    ctx.lineWidth = 2;

    const pointMap = {};
    for (let i = 0; i < keypoints.length; i++) {
        const kp = keypoints[i];
        if (kp.score > 0.5) {
            const name = BLAZEPOSE_KEYPOINT_NAMES[i];
            pointMap[name] = kp;
        }
    }

    connections.forEach(([a, b]) => {
        const kp1 = pointMap[a];
        const kp2 = pointMap[b];
        if (kp1 && kp2) {
            ctx.beginPath();
            ctx.moveTo(kp1.x, kp1.y);
            ctx.lineTo(kp2.x, kp2.y);
            ctx.stroke();
        }
    });
}

function updateStatus(status) {
    const el = document.getElementById('statusBelajar');
    if (!el) return;
    el.textContent = status;

    if (status.includes("Fokus")) {
        el.className = "text-2xl font-bold text-green-600";
    } else {
        el.className = "text-2xl font-bold text-red-600";
    }

    window.onPoseStatusUpdate?.(status);
}
