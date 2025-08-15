<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Chat') }}
        </x-header>
    </x-slot>
    
    <div class="flex flex-col h-[calc(100vh-220px)] max-w-5xl mx-auto bg-gray-900 rounded-lg overflow-hidden">
        <!-- Chat Area -->
        <div class="flex-1 overflow-y-auto" id="chat-box">
            <div id="empty-state" class="flex flex-col items-center justify-center h-full text-center px-4">
                <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-gray-100 mb-1">Como posso ajudar você hoje?</h2>
                <p class="text-gray-400 text-sm">Comece uma conversa digitando uma mensagem abaixo</p>
            </div>
            
            <div id="messages-container" class="hidden">
                <!-- Messages will be inserted here -->
            </div>
        </div>

        <!-- Input Area -->
        <div class="border-t border-gray-700 bg-gray-900 p-3">
            <div class="max-w-4xl mx-auto">
                <div class="relative">
                    <textarea 
                        id="message" 
                        rows="1" 
                        class="w-full resize-none rounded-xl border border-gray-600 bg-gray-800 px-3 py-2.5 pr-10 text-sm text-gray-100 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 max-h-24 overflow-hidden"
                        placeholder="Envie uma mensagem..."
                    ></textarea>
                    <button 
                        id="send-button" 
                        disabled
                        class="absolute right-1.5 top-1/2 -translate-y-1/2 flex h-7 w-7 items-center justify-center rounded-lg bg-gray-600 text-gray-400 transition-colors hover:bg-gray-500 disabled:cursor-not-allowed disabled:opacity-50 enabled:bg-blue-600 enabled:text-white enabled:hover:bg-blue-700"
                    >
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </button>
                </div>
                <div class="mt-1.5 text-center text-[10px] text-gray-500">
                    O Chat pode cometer erros. Considere verificar informações importantes.
                </div>
            </div>
        </div>
    </div>

<style>
    /* Custom scrollbar for chat */
    #chat-box::-webkit-scrollbar {
        width: 4px;
    }
    
    #chat-box::-webkit-scrollbar-track {
        background: transparent;
    }
    
    #chat-box::-webkit-scrollbar-thumb {
        background-color: #4b5563;
        border-radius: 2px;
    }
    
    #chat-box::-webkit-scrollbar-thumb:hover {
        background-color: #6b7280;
    }
    
    /* Hide scrollbar for Firefox */
    #chat-box {
        scrollbar-width: thin;
        scrollbar-color: #4b5563 transparent;
    }
</style>

<script>
    (function () {
        const sendButton = document.getElementById('send-button');
        const messageInput = document.getElementById('message');
        const chatBox = document.getElementById('chat-box');
        const emptyState = document.getElementById('empty-state');
        const messagesContainer = document.getElementById('messages-container');

        function scrollToBottom() {
            chatBox.scrollTo({ top: chatBox.scrollHeight, behavior: 'smooth' });
        }

        function toggleEmptyState() {
            const hasMessages = messagesContainer.children.length > 0;
            emptyState.style.display = hasMessages ? 'none' : 'flex';
            messagesContainer.style.display = hasMessages ? 'block' : 'none';
        }

        function createMessage(text, isUser = true) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `flex gap-3 p-4 ${isUser ? 'bg-gray-800' : 'bg-gray-900'}`;

            // Avatar
            const avatar = document.createElement('div');
            avatar.className = 'flex-shrink-0';
            
            if (isUser) {
                avatar.innerHTML = `
                    <div class="w-7 h-7 bg-blue-600 rounded-sm flex items-center justify-center">
                        <span class="text-white text-xs font-medium">U</span>
                    </div>
                `;
            } else {
                avatar.innerHTML = `
                    <div class="w-7 h-7 bg-green-600 rounded-sm flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                `;
            }

            // Content
            const content = document.createElement('div');
            content.className = 'flex-1 min-w-0';
            
            const textDiv = document.createElement('div');
            textDiv.className = 'text-gray-100 text-sm leading-relaxed whitespace-pre-wrap break-words';
            textDiv.textContent = text;
            
            content.appendChild(textDiv);

            messageDiv.appendChild(avatar);
            messageDiv.appendChild(content);

            return messageDiv;
        }

        function addMessage(text, isUser = true) {
            const message = createMessage(text, isUser);
            messagesContainer.appendChild(message);
            toggleEmptyState();
            scrollToBottom();
        }

        function autoresizeTextarea() {
            messageInput.style.height = 'auto';
            const newHeight = Math.min(messageInput.scrollHeight, 96); // max-h-24 = 96px
            messageInput.style.height = newHeight + 'px';
        }

        function sendMessage() {
            const text = messageInput.value.trim();
            if (!text) return;

            // Add user message
            addMessage(text, true);
            
            // Clear input
            messageInput.value = '';
            sendButton.disabled = true;
            autoresizeTextarea();

            // Simulate AI response
            setTimeout(() => {
                const responses = [
                    'Entendi sua pergunta. Vou buscar as informações mais relevantes para você.',
                    'Analisando seu pedido... Em breve terei uma resposta baseada nos dados disponíveis.',
                    'Processando sua solicitação. Aguarde enquanto consulto a base de conhecimento.',
                    'Compreendi. Deixe-me buscar as informações mais precisas sobre isso.',
                ];
                const randomResponse = responses[Math.floor(Math.random() * responses.length)];
                addMessage(randomResponse, false);
            }, 500);

            messageInput.focus();
        }

        // Event listeners
        sendButton.addEventListener('click', sendMessage);

        messageInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });

        messageInput.addEventListener('input', function () {
            const hasText = this.value.trim().length > 0;
            sendButton.disabled = !hasText;
            autoresizeTextarea();
        });

        // Initialize
        toggleEmptyState();
        autoresizeTextarea();
        messageInput.focus();
    })();
</script>
</x-app-layout>
