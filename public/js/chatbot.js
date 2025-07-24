document.addEventListener('alpine:init', () => {
    Alpine.store('chatbotStore', {
        show: false
    });
});

function chatbot() {
    
    return {
        imagePreview: null,
        imageFile: null,
        get showChatbot() {
            return Alpine.store('chatbotStore').show;
        },
        set showChatbot(value) {
            Alpine.store('chatbotStore').show = value;
        },
        userInput: '',
        chatMessages: [
            { sender: 'assistant', text: 'Hai! Saya siap membantu kamu 😊' }
        ],
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
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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
        handleImagePreview(event) {
            const file = event.target.files[0];
            if (!file) return;

            this.imageFile = file;

            const reader = new FileReader();
            reader.onload = () => {
                this.imagePreview = reader.result;
            };
            reader.readAsDataURL(file);
        },
        cancelImage() {
            this.imagePreview = null;
            this.imageFile = null;
            document.getElementById('fileInput').value = null; 
        },


        uploadImage() {
            if (!this.imageFile) return;

            const formData = new FormData();
            formData.append("image", this.imageFile);

            this.chatMessages.push({ image: this.imagePreview, sender: 'user' });

            this.imagePreview = null;
            this.imageFile = null;

            fetch('/chat-image', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(res => {
                if (!res.ok) throw new Error("Gagal: " + res.status);
                return res.json();
            })
            .then(data => {
                const reply = data.message || 'Tidak ada balasan dari AI.';
                this.chatMessages.push({ text: reply, sender: 'assistant' });

                this.$nextTick(() => {
                    const container = document.querySelector('[x-show=showChatbot] .overflow-y-auto');
                    if (container) container.scrollTop = container.scrollHeight;
                });
            })
            .catch(err => {
                console.error(err);
                this.chatMessages.push({ text: 'Gagal mengirim gambar.', sender: 'assistant' });
            });
        }

    };
}

window.addEventListener('beforeunload', () => {
        localStorage.removeItem('chatMessages');
    });
