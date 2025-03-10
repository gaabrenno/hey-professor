<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('My Chat') }}
        </x-header>
    </x-slot>
    <div class="max-w-2xl mx-auto p-6 bg-[#1e1e2e] shadow-xl rounded-xl">    
    <div class="h-96 overflow-y-auto p-4 space-y-4 bg-[#313244] rounded-lg flex flex-col" id="chat-box">
        <!-- Mensagens do chat serão exibidas aqui -->
    </div>
    
    <div class="mt-4 flex items-center bg-[#1e1e2e] p-3 rounded-lg shadow-lg border border-[#45475a]">
        <input type="text" id="message" class="flex-1 p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#cba6f7] text-[#cdd6f4] bg-[#45475a] placeholder-[#a6adc8]" placeholder="Digite sua mensagem...">
        <button id="send-button" class="ml-3 px-5 py-3 bg-[#cba6f7] text-[#1e1e2e] font-semibold rounded-lg hover:bg-[#b4befe] transition-all">Enviar</button>
    </div>
</div>

<script>
    document.getElementById('send-button').addEventListener('click', function () {
        let messageInput = document.getElementById('message');
        let messageText = messageInput.value.trim();
        let chatBox = document.getElementById('chat-box');
        
        if (messageText) {
            let messageElement = document.createElement('div');
            messageElement.className = 'bg-[#cba6f7] text-[#1e1e2e] p-3 rounded-xl max-w-xs self-end ml-auto shadow-md';
            messageElement.textContent = messageText;
            chatBox.appendChild(messageElement);
            chatBox.scrollTop = chatBox.scrollHeight;
            messageInput.value = '';
        }
    });
</script>
</x-app-layout>
