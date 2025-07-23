let lastObjectStatus = "Tidak terdeteksi 📵";
let lastObjectTime = Date.now();

window.setupObjectDetection = async function () {
    window.objectModel = await cocoSsd.load();
    console.log("✅ Object detection siap");
};

window.detectObjects = async function (video, ctx, playWarning) {
    if (!window.objectModel || !ctx || !ctx.canvas) {
        console.warn("❌ Object model atau canvas context belum siap.");
        return "Tidak terdeteksi";
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

    let newStatus = phoneDetected ? "cell phone" : "Tidak terdeteksi";

    // Logika delay 2 detik
    if (newStatus === lastObjectStatus) {
        lastObjectTime = now;
    } else {
        if (now - lastObjectTime >= 2000) {
            lastObjectStatus = newStatus;
            updateObjectStatus(newStatus);

            // Update global objectStatus untuk digunakan di main.js
            window.objectStatus = newStatus;
            
            // Trigger callback untuk update status gabungan
            if (window.onObjectDetected) {
                window.onObjectDetected(newStatus);
            }

            if (newStatus === "cell phone") {
                playWarning("Jangan main HP ya!");
            }

            lastObjectTime = now;
        } else {
            console.log(`⌛ Menunggu 2 detik status objek: ${newStatus}`);
        }
    }
    
    return lastObjectStatus;
};

function updateObjectStatus(status) {
    const el = document.getElementById('statusObject');
    if (!el) return;

    const displayText = status === "cell phone" ? "Main HP 📱" : "Tidak terdeteksi 📵";
    el.textContent = displayText;

    if (status === "cell phone") {
        el.className = "text-xl font-semibold text-red-600";
    } else {
        el.className = "text-xl font-semibold text-green-600";
    }
}