let lastObjectStatus = "Tidak terdeteksi 📵";
let lastObjectTime = Date.now();

window.setupObjectDetection = async function () {
    window.objectModel = await cocoSsd.load();
    console.log("✅ Object detection siap");
};

window.detectObjects = async function (video, ctx, playWarning) {
    if (!window.objectModel || !ctx || !ctx.canvas) {
        console.warn("❌ Object model atau canvas context belum siap.");
        return;
    }

    const predictions = await window.objectModel.detect(video);
    ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);

    let now = Date.now();
    let phoneDetected = false;

    for (let p of predictions) {
        // Gambar kotak
        ctx.beginPath();
        ctx.rect(...p.bbox);
        ctx.strokeStyle = "red";
        ctx.lineWidth = 2;
        ctx.stroke();

        ctx.font = "14px Arial";
        ctx.fillStyle = "red";
        ctx.fillText(p.class, p.bbox[0], p.bbox[1] > 10 ? p.bbox[1] - 5 : 10);

        if (p.class === "cell phone") {
            phoneDetected = true;
        }
    }

    let newStatus = phoneDetected ? "Main HP 📱" : "Tidak terdeteksi 📵";

    // Logika delay 2 detik
    if (newStatus === lastObjectStatus) {
        lastObjectTime = now;
    } else {
        if (now - lastObjectTime >= 2000) {
            lastObjectStatus = newStatus;
            updateObjectStatus(newStatus);

            if (newStatus === "Main HP 📱") {
                playWarning("Jangan main HP ya!");
            }

            lastObjectTime = now;
        } else {
            console.log(`⌛ Menunggu 2 detik status objek: ${newStatus}`);
        }
    }
    if (!window.objectModel) {
        console.warn("⛔ objectModel belum diload!");
        return;
    }
    if (!ctx || !ctx.canvas) {
        console.warn("⛔ Context canvas belum siap!");
        return;
    }
};

function updateObjectStatus(status) {
    const el = document.getElementById('statusObject');
    if (!el) return;

    el.textContent = status;

    if (status.includes("Main HP")) {
        el.className = "text-xl font-semibold text-red-600";
    } else {
        el.className = "text-xl font-semibold text-green-600";
    }
}
async function loopDeteksi() {
    if (!video || !ctx || video.paused || video.ended) return;

    await detectPose(video, canvas, ctx);
    await detectObjects(video, canvas, ctx, playWarning);
    requestAnimationFrame(loopDeteksi);
}

window.onObjectDetected?.(newStatus);