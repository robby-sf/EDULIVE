import * as cocoSsd from '@tensorflow-models/coco-ssd';
import * as tf from '@tensorflow/tfjs';

let objectModel;

async function setupObjectDetection() {
    objectModel = await cocoSsd.load();
    console.log("✅ Object detection siap");
}

async function detectObjects() {
    const predictions = await objectModel.detect(video);
    for (let p of predictions) {
        // tampilkan di canvas
        ctx.beginPath();
        ctx.rect(...p.bbox);
        ctx.strokeStyle = "red";
        ctx.stroke();
        ctx.fillText(p.class, p.bbox[0], p.bbox[1] > 10 ? p.bbox[1] - 5 : 10);

        // contoh alert
        if (p.class === "cell phone") {
            playWarning("Jangan main HP ya!");
        }
    }
}
