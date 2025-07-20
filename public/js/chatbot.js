function chatbot() {
    return {
        showChatbot: true,
        userInput: '',
        chatMessages: [],
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
        }
    };
}
