let detector;
let lastFocusTime = Date.now();
let lastStatus = "Fokus ✅";
let pendingStatus = "";
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
    if (!detector) return;

    detector.estimatePoses(video).then(poses => {
        let now = Date.now();
        let newStatus = "Fokus ✅";
        let isFokus = false;

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
                const headBelowShoulders = nose.y - avgShoulderY > 60;

                const earAligned = leftEar && rightEar &&
                    leftEar.score > 0.3 && rightEar.score > 0.3 &&
                    Math.abs(leftEar.y - rightEar.y) < 15;

                const shouldersFlat = Math.abs(leftShoulder.y - rightShoulder.y) < 15;

                if (headBelowShoulders) {
                    newStatus = "Menunduk 📱";
                } else if (earAligned && shouldersFlat) {
                    newStatus = "Tiduran 🛌";
                } else {
                    newStatus = "Fokus ✅";
                    isFokus = true;
                }
            }

            drawKeypoints(keypoints, canvas, ctx);
        } else {
            newStatus = "Keluar Frame ❌";
        }

        if (newStatus === "Fokus ✅") {
            lastFocusTime = now;
            if (lastStatus !== "Fokus ✅") {
                lastStatus = "Fokus ✅";
                updateStatus("Fokus ✅");
            }
        } else {
            if (now - lastFocusTime >= 2000) {
                if (lastStatus !== newStatus) {
                    lastStatus = newStatus;
                    updateStatus(newStatus);
                }
            } else {
                console.log(`⌛ Belum 2 detik, tetap status: ${lastStatus}`);
            }
        }

        requestAnimationFrame(() => detectPoseLoop(video, canvas, ctx));
    });
}


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
}

window.onPoseStatusUpdate?.(newStatus);
