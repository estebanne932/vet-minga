<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Minga Clínica Veterinaria</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="relative bg-[#f5f7fb] text-gray-800 overflow-x-hidden overflow-y-auto">

    {{-- Background --}}
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div class="absolute top-[-150px] left-[-100px] w-[500px] h-[500px] bg-[#7b3b7f]/20 blur-3xl rounded-full"></div>
        <div class="absolute bottom-[-200px] right-[-100px] w-[500px] h-[500px] bg-[#008b8f]/20 blur-3xl rounded-full"></div>
    </div>

    {{-- Navbar --}}
    <header class="relative z-20">
        <div class="max-w-7xl mx-auto px-6 py-6 flex items-center justify-between">

            <div class="flex items-center gap-4">
               <img
                    src="{{ asset('images/logo.png') }}"
                    alt="Logo"
                    class="h-9 w-auto"
                    >

                <div>
                    <h1 class="text-2xl font-extrabold text-[#1f2937] leading-none">MINGA</h1>
                    <p class="text-sm text-gray-500 tracking-wide">Clínica Veterinaria</p>
                </div>
            </div>

            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="px-6 py-3 rounded-2xl bg-[#008b8f] hover:bg-[#007378] text-white font-semibold transition shadow-xl shadow-cyan-500/20">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="px-6 py-3 rounded-2xl border border-gray-200 bg-white/70 backdrop-blur-xl hover:bg-white transition font-semibold text-gray-700">
                        Iniciar sesión
                    </a>
                @endauth
            @endif

        </div>
    </header>

    {{-- Hero --}}
    <main class="relative z-10 min-h-screen">
        <section class="max-w-7xl mx-auto px-6 py-10 lg:py-16 grid lg:grid-cols-2 gap-16 items-center">

            {{-- Left --}}
            <div>

                <h1 class="text-5xl lg:text-7xl font-extrabold leading-tight text-gray-900">
                    Cuidando mascotas
                    con una gestión
                    <span class="text-[#008b8f]">inteligente</span>
                </h1>

                <p class="mt-8 text-xl text-gray-600 leading-relaxed max-w-2xl">
                    Administra consultas, expedientes, vacunas, tratamientos y hospitalización desde un solo lugar,
                    con una experiencia moderna y eficiente.
                </p>

                <div class="flex flex-wrap gap-4 mt-10">
                    <a href="{{ route('login') }}"
                       class="px-8 py-4 rounded-2xl bg-[#008b8f] hover:bg-[#007378] text-white font-semibold text-lg transition shadow-2xl shadow-cyan-500/20">
                        Entrar al sistema
                    </a>

                    <button
                        class="px-8 py-4 rounded-2xl bg-white/80 backdrop-blur-xl border border-gray-200 hover:bg-white transition text-lg font-medium">
                        Ver información
                    </button>
                </div>

            </div>

            {{-- Right --}}
            <div class="relative flex justify-center pb-8 lg:pb-0">

                <div class="absolute w-[450px] h-[450px] bg-[#008b8f]/20 blur-3xl rounded-full"></div>

                <div class="relative bg-white/70 backdrop-blur-2xl border border-white/50 rounded-[40px] p-10 shadow-2xl max-w-lg w-full">

                    <div class="flex items-center justify-between mb-10">
                        <div>
                            <p class="text-gray-500">Bienvenido a</p>
                            <h2 class="text-3xl font-extrabold text-gray-900">MINGA</h2>
                        </div>

                        <div class="w-16 h-16 rounded-3xl bg-gradient-to-br from-[#008b8f] to-[#34527a] flex items-center justify-center text-3xl shadow-xl text-white">
                            🐶
                        </div>
                    </div>

                    <div class="space-y-5">
                        <div class="bg-[#f5f7fb] rounded-3xl p-5 border border-gray-100">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-gray-500 text-sm">Consultas del día</p>
                                    <h3 class="text-3xl font-bold mt-1">18</h3>
                                </div>
                                <div class="text-4xl">🩺</div>
                            </div>
                        </div>

                        <div class="bg-[#f5f7fb] rounded-3xl p-5 border border-gray-100">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-gray-500 text-sm">Vacunas pendientes</p>
                                    <h3 class="text-3xl font-bold mt-1">7</h3>
                                </div>
                                <div class="text-4xl">💉</div>
                            </div>
                        </div>

                        <div class="bg-[#f5f7fb] rounded-3xl p-5 border border-gray-100">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-gray-500 text-sm">Pacientes registrados</p>
                                    <h3 class="text-3xl font-bold mt-1">542</h3>
                                </div>
                                <div class="text-4xl">🐾</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>

</body>
</html>