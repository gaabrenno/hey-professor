<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RAG Fast Systen</title>
    @vite('resources/css/app.css') 
</head>
<body class="bg-gray-900 text-gray-100 scroll-smooth">

    <nav class="fixed top-0 left-0 w-full bg-gray-900 bg-opacity-90 shadow-md py-4 z-50">
        <div class="max-w-6xl mx-auto flex justify-between items-center px-6">
            <a href="#" class="text-2xl font-bold text-blue-400 hover:text-blue-300 transition">RAG System</a>
            <a href="{{ route('dashboard') }}" class="px-6 py-2 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600 transition">
                Começar Agora
            </a>
        </div>
    </nav>

    <header class="min-h-[50vh] flex flex-col items-center justify-center text-center px-6">
        <h1 class="text-5xl font-extrabold bg-gradient-to-r from-blue-400 to-purple-500 text-transparent bg-clip-text">
            RAG Fast Systen
        </h1>
        <p class="mt-4 text-lg text-gray-400 max-w-2xl">
            Transforme seus dados em um sistema inteligente sem complicação.
        </p>
    </header>

    <section class="min-h-[10vh] flex flex-col items-center justify-center text-center px-6">
        <h2 class="text-3xl font-semibold text-white">Por que usar nossa plataforma?</h2>
        <div class="mt-8 grid md:grid-cols-3 gap-6 max-w-5xl">
            @foreach ([
                ['title' => 'Fácil de Usar', 'desc' => 'Basta criar sua base de dados e escolher o modelo de IA.'],
                ['title' => 'Flexível', 'desc' => 'Suporte a diferentes modelos de IA, como GPT, DeepSeek e outros.'],
                ['title' => 'Resultados Precisos', 'desc' => 'Nosso sistema melhora a qualidade das respostas geradas.']
            ] as $item)
            <div class="p-6 bg-gray-800 shadow-lg rounded-lg text-center hover:bg-gray-700 transition transform hover:scale-105 duration-300">
                <h3 class="text-xl font-semibold text-blue-400">{{ $item['title'] }}</h3>
                <p class="text-gray-400 mt-3">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </section>

    <section class="min-h-[80vh] flex flex-col items-center justify-center text-center bg-gradient-to-t from-gray-800 to-gray-900 text-white px-6">
        <h2 class="text-3xl font-semibold">Como funciona?</h2>
        <div class="mt-8 max-w-3xl grid md:grid-cols-3 gap-6">
            @foreach ([
                ['step' => '1. Criar Base de Dados', 'desc' => 'Inicie criando a base de dados que deseja utilizar.'],
                ['step' => '2. Escolha o Modelo', 'desc' => 'Selecione o LLM de sua preferência para gerar respostas.'],
                ['step' => '3. Obtenha Seu Sistema', 'desc' => 'Receba seu modelo pronto para uso e comece a interagir!']
            ] as $step)
            <div class="p-6 bg-gray-700 rounded-lg shadow-md hover:bg-gray-600 transition transform hover:scale-105 duration-300">
                <h3 class="text-lg font-semibold text-blue-300">{{ $step['step'] }}</h3>
                <p class="mt-3 text-gray-300">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </section>

    <section class="min-h-[30vh] flex flex-col items-center justify-center text-center bg-gradient-to-t from-gray-900 to-gray-800 text-white px-6">
        <h2 class="text-3xl font-semibold text-white">Pronto para começar?</h2>
        <p class="mt-3 text-gray-400 max-w-xl">
            Experimente agora e crie seu sistema RAG em poucos passos.
        </p>
        <a href="{{ route('dashboard') }}" class="mt-6 inline-block px-8 py-3 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition transform hover:scale-110">
            Começar Agora
        </a>
    </section>

    <footer class="mt-20 py-6 text-center text-gray-500 text-sm position:absolute border:0 width:100%">
        <p>© {{ date('Y') }} ARDA Inovations. Todos os direitos reservados.</p>
    </footer>

</body>
</html>
