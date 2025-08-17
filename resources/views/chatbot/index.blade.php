@extends('layouts.app')

@section('title', 'AI English Tutor')

@push('styles')
{{-- Menggunakan Tailwind CSS CDN untuk halaman ini --}}
<script src="https://cdn.tailwindcss.com"></script>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
    body {
        font-family: 'Inter', sans-serif;
    }
    #chat-log::-webkit-scrollbar { width: 8px; }
    #chat-log::-webkit-scrollbar-track { background: #f1f1f1; }
    #chat-log::-webkit-scrollbar-thumb { background: #888; border-radius: 4px; }
    #chat-log::-webkit-scrollbar-thumb:hover { background: #555; }
    .typing-indicator p::after {
        content: '...';
        animation: typing 1s infinite;
    }
    @keyframes typing {
        0% { content: '.'; } 33% { content: '..'; } 66% { content: '...'; }
    }
    /* Override background color dari layout utama */
    main { background-color: #f3f4f6; }
</style>
@endpush

@section('content')
<div class="flex flex-col" style="height: calc(100vh - 80px);"> {{-- Sesuaikan tinggi dengan tinggi navbar Anda --}}
    <header class="bg-white shadow-md w-full p-4 flex items-center border-b">
        <div class="flex items-center">
            <div class="bg-blue-500 text-white rounded-full w-10 h-10 flex items-center justify-center mr-3">
                <i class="fas fa-robot"></i>
            </div>
            <div>
                <h1 class="text-lg font-bold text-gray-800">LanguangeRoom AI Tutor</h1>
                <p class="text-sm text-green-500 flex items-center">
                    <span class="w-2 h-2 bg-green-500 rounded-full mr-1.5"></span>
                    Online
                </p>
            </div>
        </div>
    </header>

    <main id="chat-log" class="flex-1 p-4 overflow-y-auto">
        <div class="flex mb-4">
            <div class="bg-blue-500 text-white rounded-full w-8 h-8 flex items-center justify-center mr-3 self-start flex-shrink-0">
                <i class="fas fa-robot text-sm"></i>
            </div>
            <div class="bg-white rounded-lg p-3 max-w-xs md:max-w-md shadow">
                <p class="text-sm text-gray-700">Halo! Saya adalah Tutor AI Anda. Anda bisa bertanya apa saja tentang Bahasa Inggris, atau berlatih percakapan.</p>
                <button class="speak-btn text-gray-400 hover:text-blue-500 mt-2">
                    <i class="fas fa-volume-up"></i>
                </button>
            </div>
        </div>
    </main>

    <footer class="bg-white p-4 border-t">
        <form id="chat-form" class="flex items-center space-x-3">
            <input type="text" id="user-input" class="flex-1 p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ketik pesan Anda..." autocomplete="off">
            <button type="submit" id="send-btn" class="bg-blue-500 text-white rounded-full w-12 h-12 flex items-center justify-center hover:bg-blue-600 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:bg-gray-400">
                <i class="fas fa-paper-plane"></i>
            </button>
        </form>
    </footer>
</div>
@endsection {{-- <-- PERBAIKAN DI SINI, dari @endpush menjadi @endsection --}}

@push('scripts')
<script>
    // Kode JavaScript Anda (event listener, appendMessage, updateLastBotMessage, speakText)
    // ...
    const chatLog = document.getElementById('chat-log');
    const chatForm = document.getElementById('chat-form');
    const userInput = document.getElementById('user-input');
    const sendBtn = document.getElementById('send-btn');

    chatForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const userMessage = userInput.value.trim();
        if (!userMessage) return;

        appendMessage('user', userMessage);
        userInput.value = '';
        sendBtn.disabled = true;
        
        appendMessage('bot', 'Typing', true);
        
        try {
            const aiResponse = await getAIResponse(userMessage);
            updateLastBotMessage(aiResponse);
        } catch (error) {
            console.error('Error details:', error);
            const errorMessage = `Maaf, terjadi galat. (Error: ${error.message})`;
            updateLastBotMessage(errorMessage);
        } finally {
            sendBtn.disabled = false;
        }
    });

    function appendMessage(sender, message, isLoading = false) {
        const messageWrapper = document.createElement('div');
        messageWrapper.classList.add('flex', 'mb-4');
        
        let messageHTML = '';
        if (sender === 'user') {
            messageWrapper.classList.add('justify-end');
            messageHTML = `
                <div class="bg-blue-500 text-white rounded-lg p-3 max-w-xs md:max-w-md shadow">
                    <p class="text-sm">${message}</p>
                </div>`;
        } else {
            const loadingClass = isLoading ? 'typing-indicator' : '';
            messageHTML = `
                <div class="bg-blue-500 text-white rounded-full w-8 h-8 flex items-center justify-center mr-3 self-start flex-shrink-0">
                    <i class="fas fa-robot text-sm"></i>
                </div>
                <div class="bg-white rounded-lg p-3 max-w-xs md:max-w-md shadow ${loadingClass}">
                    <p class="text-sm text-gray-700">${message}</p>
                    <button class="speak-btn text-gray-400 hover:text-blue-500 mt-2" style="display: none;">
                        <i class="fas fa-volume-up"></i>
                    </button>
                </div>`;
        }
        
        messageWrapper.innerHTML = messageHTML;
        chatLog.appendChild(messageWrapper);
        chatLog.scrollTop = chatLog.scrollHeight;
    }
    
    function updateLastBotMessage(newMessage) {
        const typingIndicator = chatLog.querySelector('.typing-indicator');
        if (typingIndicator) {
            const p = typingIndicator.querySelector('p');
            const speakBtn = typingIndicator.querySelector('.speak-btn');
            
            p.innerHTML = newMessage.replace(/\n/g, '<br>');
            typingIndicator.classList.remove('typing-indicator');
            
            if (speakBtn) {
                speakBtn.style.display = 'inline-block';
            }
        }
    }

    function speakText(text) {
        window.speechSynthesis.cancel();
        const utterance = new SpeechSynthesisUtterance(text);
        const voices = window.speechSynthesis.getVoices();
        let englishVoice = voices.find(voice => voice.lang.startsWith('en-US') || voice.lang.startsWith('en-GB'));
        utterance.voice = englishVoice || voices[0];
        utterance.pitch = 1;
        utterance.rate = 1;
        utterance.volume = 1;
        window.speechSynthesis.speak(utterance);
    }

    chatLog.addEventListener('click', (e) => {
        const speakButton = e.target.closest('.speak-btn');
        if (speakButton) {
            const messageContainer = speakButton.parentElement;
            const messageText = messageContainer.querySelector('p').innerText;
            speakText(messageText);
        }
    });

    async function getAIResponse(prompt) {
        const response = await fetch("{{ route('chatbot.chat') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ prompt: prompt })
        });

        const result = await response.json();

        if (!response.ok) {
            throw new Error(result.error || 'Unknown server error');
        }
        
        return result.reply;
    }
</script>
@endpush