<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Veterinaria ERP</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

    <body class="bg-[#071018] text-white overflow-hidden">

        {{-- Background --}}
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-cyan-500/20 blur-3xl rounded-full"></div>
            <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-blue-600/20 blur-3xl rounded-full"></div>
        </div>

        {{-- Navbar --}}
        <header class="relative z-10 border-b border-white/10 backdrop-blur-xl">
            <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">

                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-2xl bg-cyan-500 flex items-center justify-center text-2xl shadow-lg shadow-cyan-500/30">
                        🐾
                    </div>

                    <div>
                        <h1 class="font-bold text-xl">VetERP</h1>
                        <p class="text-xs text-gray-400">Sistema Veterinario</p>
                    </div>
                </div>

                @if (Route::has('login'))
                    <nav class="flex items-center gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                            class="px-5 py-2 rounded-xl bg-cyan-500 hover:bg-cyan-400 transition font-medium">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                            class="text-gray-300 hover:text-white transition">
                                Iniciar sesión
                            </a>
                        @endauth
                    </nav>
                @endif

            </div>
        </header>

        {{-- Hero --}}
        <section class="relative z-10 min-h-[85vh] flex items-center">

            <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">

                {{-- Left --}}
                <div>

                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-cyan-500/10 border border-cyan-400/20 text-cyan-300 text-sm mb-6">
                        ✨ ERP profesional para clínicas veterinarias
                    </div>

                    <h1 class="text-6xl font-extrabold leading-tight mb-6">
                        Administra tu
                        <span class="text-cyan-400">
                            veterinaria
                        </span>
                        de forma inteligente
                    </h1>

                    <p class="text-gray-400 text-lg leading-relaxed mb-8 max-w-xl">
                        Gestiona pacientes, consultas, vacunas, inventario,
                        hospitalización y reportes desde un solo sistema moderno.
                    </p>

                    <div class="flex gap-4">
                        <a href="{{ route('login') }}"
                        class="px-7 py-4 rounded-2xl bg-cyan-500 hover:bg-cyan-400 transition font-semibold shadow-2xl shadow-cyan-500/30">
                            Entrar al sistema
                        </a>

                        <button class="px-7 py-4 rounded-2xl border border-white/10 bg-white/5 hover:bg-white/10 transition">
                            Ver demo
                        </button>
                    </div>

                    {{-- Stats --}}
                    <div class="grid grid-cols-3 gap-4 mt-12">

                        <div class="bg-white/5 border border-white/10 rounded-2xl p-5 backdrop-blur-xl">
                            <h3 class="text-3xl font-bold">+3K</h3>
                            <p class="text-gray-400 text-sm">Pacientes</p>
                        </div>

                        <div class="bg-white/5 border border-white/10 rounded-2xl p-5 backdrop-blur-xl">
                            <h3 class="text-3xl font-bold">98%</h3>
                            <p class="text-gray-400 text-sm">Eficiencia</p>
                        </div>

                        <div class="bg-white/5 border border-white/10 rounded-2xl p-5 backdrop-blur-xl">
                            <h3 class="text-3xl font-bold">24/7</h3>
                            <p class="text-gray-400 text-sm">Acceso</p>
                        </div>

                    </div>

                </div>

                {{-- Right --}}
                <div class="relative">

                    <div class="absolute inset-0 bg-cyan-500/20 blur-3xl rounded-full"></div>

                    <div class="relative bg-white/5 border border-white/10 rounded-[32px] p-6 backdrop-blur-2xl shadow-2xl">

                        {{-- Fake Dashboard --}}
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h2 class="font-bold text-xl">Dashboard</h2>
                                <p class="text-gray-400 text-sm">
                                    Clínica veterinaria
                                </p>
                            </div>

                            <div class="w-12 h-12 rounded-2xl bg-cyan-500 flex items-center justify-center">
                                🐶
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">

                            <div class="bg-[#0d1823] rounded-2xl p-5 border border-white/5">
                                <p class="text-gray-400 text-sm">Consultas</p>
                                <h3 class="text-3xl font-bold mt-2">128</h3>
                            </div>

                            <div class="bg-[#0d1823] rounded-2xl p-5 border border-white/5">
                                <p class="text-gray-400 text-sm">Vacunas</p>
                                <h3 class="text-3xl font-bold mt-2">64</h3>
                            </div>

                            <div class="bg-[#0d1823] rounded-2xl p-5 border border-white/5">
                                <p class="text-gray-400 text-sm">Hospitalizados</p>
                                <h3 class="text-3xl font-bold mt-2">12</h3>
                            </div>

                            <div class="bg-[#0d1823] rounded-2xl p-5 border border-white/5">
                                <p class="text-gray-400 text-sm">Inventario</p>
                                <h3 class="text-3xl font-bold mt-2">89%</h3>
                            </div>

                        </div>

                        <div class="mt-6 bg-[#0d1823] rounded-2xl p-5 border border-white/5">
                            <div class="flex justify-between mb-3">
                                <span class="text-gray-400">Actividad diaria</span>
                                <span class="text-cyan-400">+18%</span>
                            </div>

                            <div class="h-3 bg-white/5 rounded-full overflow-hidden">
                                <div class="h-full w-[75%] bg-cyan-500 rounded-full"></div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </section>

    </body>
</html>