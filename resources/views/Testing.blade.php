@extends('layouts.app')

@section('title', 'Teman Belajar')

@section('content')
<div x-data="{
        showStartButton: true,
        showCameraControls: false,
        videoStream: null,
        timer: 0,
        timerInterval: null,
        sessionStartTime: null,
        focusSeconds: 0,
        distractionSeconds: 0,
        distractionLog: [],
        async startCamera() {
            console.log('📷 Tombol Mulai diklik');
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ video: true });
                const videoElement = document.getElementById('video');
                videoElement.srcObject = stream;
                await videoElement.play();
                this.videoStream = stream;
                this.showStartButton = false;
                this.showCameraControls = true;

                this.sessionStartTime = new Date();
                this.focusSeconds = 0;
                this.distractionSeconds = 0;
                this.distractionLog = [];

                this.timer = 0;
                this.timerInterval = setInterval(() => {
                    this.timer++;
                    this.focusSeconds++;
                }, 1000);
            } catch (error) {
                this.showMessage('Gagal mengakses kamera: ' + error.message, 'error');
            }
        },
        async stopCamera() {
            if (this.videoStream) {
                this.videoStream.getTracks().forEach(track => track.stop());
                this.videoStream = null;
                document.getElementById('video').srcObject = null;
                clearInterval(this.timerInterval);

                const sessionData = {
                    started_at: this.sessionStartTime.toISOString(),
                    ended_at: new Date().toISOString(),
                    focus_duration: Math.round(this.focusSeconds / 60), // Kirim dalam menit
                    distraction_duration: Math.round(this.distractionSeconds / 60), // Kirim dalam menit
                    distractions: this.distractionLog, // Kirim sebagai array
                };

                try {
            console.log('Mengirim data sesi:', sessionData);
            this.showMessage('Menyimpan sesi...', 'info');

            const response = await fetch('/study-session', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').getAttribute('content')
                },
                body: JSON.stringify(sessionData),
            });

            const result = await response.json();

            if (response.ok) {
                this.showMessage('Sesi berhasil disimpan!', 'info');
                console.log('Respons dari server:', result);
            } else {
                // Jika ada error validasi dari server
                throw new Error(result.message || 'Gagal menyimpan sesi.');
            }

            } catch (error) {
            this.showMessage('Error: ' + error.message, 'error');
            console.error('Gagal mengirim data ke server:', error);
            }

            this.showStartButton = true;
            this.showCameraControls = false;
            this.timer = 0;
            }
        },
        showMessage(message, type = 'info') {
            const messageBox = document.createElement('div');
            messageBox.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg text-white ${type === 'error' ? 'bg-red-500' : 'bg-gray-700'}`;
            messageBox.textContent = message;
            document.body.appendChild(messageBox);
            setTimeout(() => { messageBox.remove(); }, 3000);
        },
        startListening() {
            if (!('webkitSpeechRecognition' in window)) {
                alert('Browser tidak mendukung Speech Recognition');
                return;
            }

            const recognition = new webkitSpeechRecognition();
            recognition.lang = 'id-ID';
            recognition.interimResults = false;
            recognition.maxAlternatives = 1;

            recognition.start();

            recognition.onresult = (event) => {
                const result = event.results[0][0].transcript;
                this.userInput = result;
            };

            recognition.onerror = (event) => {
                console.error('STT error', event.error);
            };
        }

    }" class="min-h-screen flex flex-col flex-grow">

    <div class="flex flex-grow overflow-hidden">
        <div :class="{'w-full': !$store.chatbotStore.show, 'w-3/5': $store.chatbotStore.show}" class="relative flex flex-col items-center justify-center p-4 transition-all duration-300">

            <h1 class="text-3xl font-bold text-gray-900 mb-4" x-show="showStartButton" x-cloak>Teman Belajar</h1>
            <p class="text-gray-700 mb-6" x-show="showStartButton" x-cloak>Akses kamera sedang diaktifkan...</p>

            <div class="relative w-full max-w-4xl aspect-video bg-gray-200 rounded-lg shadow-lg border-4 border-gray-300 overflow-hidden">
                <video id="video" autoplay muted playsinline class="absolute top-0 left-0 w-full h-full object-contain z-10"
                    x-show="showCameraControls"
                    x-cloak></video>
                <canvas id="output" class="absolute top-0 left-0 w-full h-full object-contain z-50 !pointer-events-none"></canvas>
                <div x-show="showStartButton" x-cloak class="absolute inset-0 flex items-center justify-center text-gray-500 text-xl z-0">
                    Kamera belum aktif
                </div>
                <div class="absolute top-4 left-4 bg-black bg-opacity-60 text-white px-3 py-1 rounded-lg text-sm z-30" x-show="showCameraControls" x-cloak>
                    <template x-if="showCameraControls">
                        <span x-text="new Date(timer * 1000).toISOString().substr(14, 5)"></span>

                        <button @click="stopCamera(); window.stopSession()"
                            class="px-8 py-3 bg-red-600 text-white font-semibold rounded-full shadow-lg hover:bg-red-500 transition-colors duration-300">
                            Stop
                        </button>

                    </template>
                </div>
                <div class="absolute bottom-4 right-4 bg-white bg-opacity-80 text-gray-800 text-sm p-2 rounded-md shadow-md z-30"
                    x-show="showCameraControls" x-cloak>
                    <p class="font-semibold">Status Postur:</p>
                    <p id="statusBelajar" class="text-lg font-bold text-green-600">Fokus ✅</p>
                </div>
            </div>

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

                <button @click="$store.chatbotStore.show = !$store.chatbotStore.show" class="bg-gray-200 text-gray-700 p-4 rounded-full shadow-md hover:bg-gray-300 transition">
                    <i class="fas fa-robot text-xl"></i>
                </button>
            </div>
        </div>

        <div x-data="chatbot()" x-cloak x-show="$store.chatbotStore.show" class="w-2/5 flex flex-col bg-white shadow-lg border-l border-gray-200 overflow-hidden">
            <div class="p-4 border-b">
                <h2 class="text-xl font-semibold text-gray-800">Chatbot</h2>
            </div>

            <div class="flex-1 min-h-0 max-h-[calc(100vh-200px)] overflow-y-auto p-4 flex flex-col space-y-2">
                <template x-for="(message, index) in chatMessages" :key="index">
                    <div :class="{ 'self-end': message.sender === 'user', 'self-start': message.sender === 'assistant' }" class="max-w-[70%] mb-2">
                        <template x-if="message.text">
                            <div :class="message.sender === 'user' ? 'bg-gray-900 text-white' : 'bg-gray-200 text-gray-900'" class="py-3 px-4 rounded-2xl break-words">
                                <span x-text="message.text"></span>
                            </div>
                        </template>
                        <template x-if="message.image">
                            <img :src="message.image" class="rounded-lg shadow max-w-full">
                        </template>
                    </div>
                </template>
            </div>

            <template x-if="imagePreview">
                <div class="px-4 pb-2">
                    <img :src="imagePreview" alt="Preview" class="max-w-xs rounded shadow mb-2">
                    <button @click="cancelImage" class="text-red-500 text-sm">Batal Kirim Gambar</button>
                </div>
            </template>

            <div class="relative flex items-center border-t p-4 bg-gray-50">
                <div class="relative">
                    <input
                        type="file"
                        id="fileInput"
                        accept="image/*"
                        @change="handleImagePreview"
                        class="absolute inset-0 opacity-0 cursor-pointer z-10">
                    <button class="bg-gray-200 text-gray-700 rounded-full p-3 mr-2 hover:bg-gray-300">
                        <i class="fas fa-plus text-lg"></i>
                    </button>
                </div>

                <button @click="startListening" class="bg-gray-200 text-gray-700 rounded-full p-3 ml-2 hover:bg-gray-300">
                    <i class="fas fa-microphone text-lg"></i>
                </button>

                <input
                    x-model="userInput"
                    type="text"
                    placeholder="Tulis pesanmu..."
                    class="flex-grow border border-gray-300 rounded-full py-3 px-5 outline-none focus:border-gray-700"
                    @keydown.enter.prevent="imagePreview ? uploadImage() : sendMessage()">

                    <button
                        @click="imagePreview ? uploadImage() : sendMessage()"
                        class="bg-gray-900 text-white rounded-full p-3 ml-2 hover:bg-gray-800"
                    >
                        <i class="fas fa-paper-plane text-lg"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
{{-- Semua script khusus untuk halaman ini sekarang ada di sini --}}
<script src="{{ asset('js/chatbot.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@3.3.0"></script>
<script src="https://cdn.jsdelivr.net/gh/justadudewhohacks/face-api.js@master/dist/face-api.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/pose-detection"></script>
<script src="https://cdn.jsdelivr.net/npm/@mediapipe/pose"></script>
<script defer src="https://cdn.jsdelivr.net/npm/@tensorflow-models/coco-ssd@2.2.2/dist/coco-ssd.min.js"></script>

<script src="{{ asset('js/pose.js') }}"></script>
<script src="{{ asset('js/face.js') }}"></script>
<script src="{{ asset('js/object.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
@endpush