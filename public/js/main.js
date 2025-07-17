import { setupPoseDetection } from './poseDetection.js';
// import { setupFaceDetection } from './faceDetection.js'; ← nanti tinggal aktifkan
// import { setupObjectDetection } from './objectDetection.js'; ← nanti juga

window.onload = () => {
    const video = document.getElementById('video');
    const canvas = document.getElementById('output');
    const ctx = canvas.getContext('2d');

    navigator.mediaDevices.getUserMedia({ video: true }).then((stream) => {
        video.srcObject = stream;

        video.onloadedmetadata = () => {
            video.play();
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;

            setupPoseDetection(video, canvas, ctx);
            // setupFaceDetection(video, canvas, ctx);
            // setupObjectDetection(video, canvas, ctx);
        };
    });
};
