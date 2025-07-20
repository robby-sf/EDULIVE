<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Teman Belajar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styling Alpine hidden -->
    <style>[x-cloak] { display: none !important; }</style>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite(['resources/css/app.css'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
</head>
<body class="bg-gray-100 min-h-screen flex flex-col font-sans">

    <div x-data="{
        showStartButton: true,
        showCameraControls: false,
        showChatbot: false,
        videoStream: null,
        timer: 0,
        timerInterval: null,
        userInput: '',
        chatMessages: [
            { sender: 'assistant', text: 'Hai! Saya siap membantu kamu 😊' }
        ],
        async startCamera() {
            console.log('📷 Tombol Mulai diklik');
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ video: true });
                const videoElement = document.getElementById('video');
                videoElement.srcObject = stream;
                await videoElement.play(); // 🟢 WAJIB AGAR BlazePose DAPAT FRAME
                this.videoStream = stream;
                this.showStartButton = false;
                this.showCameraControls = true;
                this.timer = 0;
                this.timerInterval = setInterval(() => {
                    this.timer++;
                }, 1000);
            } catch (error) {
                this.showMessage('Gagal mengakses kamera: ' + error.message, 'error');
            }
        },
        stopCamera() {
            if (this.videoStream) {
                this.videoStream.getTracks().forEach(track => track.stop());
                this.videoStream = null;
                document.getElementById('video').srcObject = null;
                this.showStartButton = true;
                this.showCameraControls = false;
                clearInterval(this.timerInterval);
                this.timer = 0;
            }
        },
        toggleChatbot() {
            this.showChatbot = !this.showChatbot;
        },
        sendMessage() {
            const message = this.userInput.trim();
            if (!message) return;

            this.chatMessages.push({ text: message, sender: 'user' });
            this.userInput = '';

            fetch('/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
                },
                body: JSON.stringify({ message })
            })
            .then(res => res.json())
            .then(data => {
                const reply = data.choices?.[0]?.message?.content || 'Tidak ada balasan dari AI.';
                this.chatMessages.push({ text: reply, sender: 'assistant' });

                this.$nextTick(() => {
                    const container = document.querySelector('[x-show=showChatbot] .overflow-y-auto');
                    if (container) container.scrollTop = container.scrollHeight;
                });
            })
            .catch(() => {
                this.chatMessages.push({ text: 'Gagal menghubungi AI.', sender: 'assistant' });
            });
        },
        showMessage(message, type = 'info') {
            const messageBox = document.createElement('div');
            messageBox.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg text-white ${type === 'error' ? 'bg-red-500' : 'bg-gray-700'}`;
            messageBox.textContent = message;
            document.body.appendChild(messageBox);
            setTimeout(() => { messageBox.remove(); }, 3000);
        }
    }" class="min-h-screen flex flex-col flex-grow">


    <!-- Navigation -->
    <nav class="bg-white shadow-md p-4 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <img src="https://placehold.co/30x30/000000/FFFFFF?text=EL" class="rounded-full">
            <span class="font-bold text-lg text-gray-900">EDULIVE</span>
        </div>
        <div class="hidden md:flex space-x-8 text-gray-700 font-medium">
            <a href="#" class="hover:text-gray-900">HOME</a>
            <a href="#" class="hover:text-gray-900">LEARNING</a>
            <a href="#" class="hover:text-gray-900">DASHBOARD</a>
            <a href="#" class="hover:text-gray-900">CHATBOT</a>
            <a href="#" class="hover:text-gray-900">ABOUT US</a>
        </div>
        <div class="flex items-center space-x-4">
            <span class="text-gray-900 font-medium">UDIN LETSBIE</span>
            <img src="https://placehold.co/40x40/000000/FFFFFF?text=U" class="rounded-full">
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex flex-grow overflow-hidden">
        <div :class="{'w-full': !showChatbot, 'w-3/5': showChatbot}" class="relative flex flex-col items-center justify-center p-4 transition-all duration-300">

            <h1 class="text-3xl font-bold text-gray-900 mb-4" x-show="showStartButton" x-cloak>Teman Belajar</h1>
            <p class="text-gray-700 mb-6" x-show="showStartButton" x-cloak>Akses kamera sedang diaktifkan...</p>

            <div class="relative w-full max-w-4xl aspect-video bg-gray-200 rounded-lg shadow-lg border-4 border-gray-300 overflow-hidden">
                <video id="video" autoplay muted playsinline  class="absolute top-0 left-0 w-full h-full object-contain z-10"
                    x-show="showCameraControls"
                x-cloak></video>
                <canvas id="output" class="absolute top-0 left-0 w-full h-full object-contain z-50 !pointer-events-none"></canvas>
                <div x-show="showStartButton" x-cloak class="absolute inset-0 flex items-center justify-center text-gray-500 text-xl z-0">
                    Kamera belum aktif
                </div>
                <div class="absolute top-4 left-4 bg-black bg-opacity-60 text-white px-3 py-1 rounded-lg text-sm z-30" x-show="showCameraControls" x-cloak>
                    <template x-if="showCameraControls">
                        <span x-text="new Date(timer * 1000).toISOString().substr(14, 5)"></span>
                    </template>
                </div>
                <div class="absolute bottom-4 right-4 bg-white bg-opacity-80 text-gray-800 text-sm p-2 rounded-md shadow-md z-30"
                    x-show="showCameraControls" x-cloak>
                    <p class="font-semibold">Status Postur:</p>
                    <p id="statusBelajar" class="text-lg font-bold text-green-600">Fokus ✅</p>
                </div>
            </div>

            <!-- Control Buttons -->
            <div class="flex justify-center items-center mt-8 space-x-4">
                <template x-if="showStartButton">
                    <button @click="startCamera()"
                        class="px-8 py-3 bg-gray-900 text-white font-semibold rounded-full shadow-lg hover:bg-gray-800 transition-colors duration-300">
                        Mulai
                    </button>
                </template>
                <template x-if="showCameraControls">
                    <button @click="stopCamera()"
                        class="px-8 py-3 bg-red-600 text-white font-semibold rounded-full shadow-lg hover:bg-red-500 transition-colors duration-300">
                        Stop
                    </button>
                </template>

                <button @click="toggleChatbot()" class="bg-gray-200 text-gray-700 p-4 rounded-full shadow-md hover:bg-gray-300 transition">
                    <i class="fas fa-robot text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Chatbot -->
        <div x-show="showChatbot" class="w-2/5 flex flex-col bg-white shadow-lg border-l border-gray-200 overflow-hidden" x-cloak>
            <div class="p-4 border-b">
                <h2 class="text-xl font-semibold text-gray-800">Chatbot</h2>
            </div>
            <div class="flex-1 min-h-0 max-h-[calc(100vh-200px)] overflow-y-auto p-4 flex flex-col space-y-2">
                <template x-for="message in chatMessages" :key="message.text">
                    <div :class="{ 'bg-gray-900 text-white self-end': message.sender === 'user', 'bg-gray-200 text-gray-900 self-start': message.sender === 'assistant' }"
                        class="max-w-[70%] py-3 px-4 rounded-2xl mb-2 break-words">
                        <span x-text="message.text"></span>
                    </div>
                </template>
            </div>
            <div class="relative flex items-center border-t p-4 bg-gray-50">
                <button class="bg-gray-200 text-gray-700 rounded-full p-3 mr-2 hover:bg-gray-300">
                    <i class="fas fa-plus text-lg"></i>
                </button>
                <input x-model="userInput" type="text" placeholder="Tulis pesanmu..."
                    class="flex-grow border border-gray-300 rounded-full py-3 px-5 outline-none focus:border-gray-700"
                    @keydown.enter="sendMessage">
                <button @click="sendMessage" class="bg-gray-900 text-white rounded-full p-3 ml-2 hover:bg-gray-800">
                    <i class="fas fa-paper-plane text-lg"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Panel Debug Status -->
<div class="w-full max-w-xl mt-6 p-4 bg-white border border-gray-300 rounded-lg shadow text-left space-y-2">
    <p class="font-semibold text-gray-800">🧪 <span class="text-indigo-600">Status Debug:</span></p>
    <p>📌 <span class="font-medium">Pose:</span> <span id="debugPose" class="text-gray-700">-</span></p>
    <p>🧠 <span class="font-medium">Ekspresi:</span> <span id="debugEmotion" class="text-gray-700">-</span></p>
    <p>📱 <span class="font-medium">Objek (HP):</span> <span id="debugObject" class="text-gray-700">-</span></p>
</div>


<!-- TensorFlow Core -->
<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@3.3.0"></script>

<script src="https://cdn.jsdelivr.net/gh/justadudewhohacks/face-api.js@master/dist/face-api.min.js"></script>

<!-- TensorFlow Model -->
<script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/pose-detection"></script>
<script src="https://cdn.jsdelivr.net/npm/@mediapipe/pose"></script>
<script defer src="https://cdn.jsdelivr.net/npm/@tensorflow-models/coco-ssd@2.2.2/dist/coco-ssd.min.js"></script>

<!-- Script kamu -->
<script src="/js/pose.js"></script>
<script src="/js/face.js"></script>
<script src="/js/object.js"></script>
<script src="/js/chatbot.js"></script>
<script src="/js/main.js"></script>


</div>
</body>
</html>
