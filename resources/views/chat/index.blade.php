<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('My Chat') }}
        </x-header>
    </x-slot>
    <div class="max-w-2xl mx-auto p-6 dark:bg-gray-800/50 shadow shadow-blue-500/50 p-4 my-4 rounded-xl">    
    <div class="h-96 overflow-y-auto p-4 space-y-4 bg-gray-700 rounded-lg flex flex-col" id="chat-box">
        <!-- Mensagens do chat serão exibidas aqui -->
    </div>
    
    <div class="mt-4 flex items-center bg-gray-700 p-3 rounded-lg shadow-lg border border-[#45475a]">
        <input type="text" id="message" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full mt-0" placeholder="Digite sua mensagem...">
        <button id="send-button" class="ml-3 px-5 py-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Enviar</button>
    </div>
</div>

<script>
    document.getElementById('send-button').addEventListener('click', function () {
        let messageInput = document.getElementById('message');
        let messageText = messageInput.value.trim();
        let chatBox = document.getElementById('chat-box');
        
        if (messageText) {
            let messageElement = document.createElement('div');
            messageElement.className = 'bg-blue-600 text-white p-3 rounded-xl max-w-xs self-end ml-auto shadow-md';
            messageElement.textContent = messageText;
            chatBox.appendChild(messageElement);
            chatBox.scrollTop = chatBox.scrollHeight;
            messageInput.value = '';
        }
    });
</script>
</x-app-layout>
