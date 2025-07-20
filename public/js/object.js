window.setupObjectDetection = async function () {
    window.objectModel = await cocoSsd.load();
    console.log("✅ Object detection siap");
};

window.detectObjects = async function (video, ctx, playWarning) {
    if (!window.objectModel) return;

    const predictions = await window.objectModel.detect(video);
    for (let p of predictions) {
        ctx.beginPath();
        ctx.rect(...p.bbox);
        ctx.strokeStyle = "red";
        ctx.lineWidth = 2;
        ctx.stroke();

        ctx.font = "14px Arial";
        ctx.fillStyle = "red";
        ctx.fillText(p.class, p.bbox[0], p.bbox[1] > 10 ? p.bbox[1] - 5 : 10);

        if (p.class === "cell phone") {
            playWarning("Jangan main HP ya!");
        }
    }
};
