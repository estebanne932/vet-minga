<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar sesión | Minga Clínica Veterinaria</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-[#f8fafc] via-white to-[#e6f7f7] text-gray-800 overflow-x-hidden">

    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div class="absolute -top-24 -left-24 w-80 h-80 bg-[#7b3b7f]/15 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -right-24 w-80 h-80 bg-[#008b8f]/15 rounded-full blur-3xl"></div>
    </div>

    <main class="relative z-10 min-h-screen flex items-center justify-center px-4 py-10">
        <div class="w-full max-w-6xl grid lg:grid-cols-2 gap-8 items-stretch">

            {{-- Panel izquierdo --}}
            <section class="hidden lg:flex flex-col justify-between rounded-[2rem] bg-[#0f172a] text-white p-10 shadow-2xl relative overflow-hidden">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(0,139,143,0.28),transparent_35%),radial-gradient(circle_at_bottom_left,rgba(123,59,127,0.18),transparent_35%)]"></div>

                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-10">
                        <img
                                    src="{{ asset('images/logo.png') }}"
                                    alt="Logo"
                                    class="h-9 w-auto"
                                >
                        <div>
                            <h1 class="text-3xl font-extrabold tracking-tight">MINGA</h1>
                            <p class="text-white/70">Clínica Veterinaria</p>
                        </div>
                    </div>

                    <h2 class="text-4xl font-bold leading-tight max-w-md">
                        Bienvenido al sistema de gestión veterinaria
                    </h2>

                    <p class="mt-5 text-white/70 text-lg leading-relaxed max-w-md">
                        Accede a consultas, expedientes, vacunas, tratamientos e información de tus pacientes desde un solo lugar.
                    </p>
                </div>

                <div class="relative z-10 grid grid-cols-3 gap-4 mt-12">
                    <div class="rounded-2xl bg-white/10 border border-white/10 p-4">
                        <p class="text-2xl font-bold text-[#2dd4bf]">24/7</p>
                        <p class="text-sm text-white/70 mt-1">Acceso</p>
                    </div>
                    <div class="rounded-2xl bg-white/10 border border-white/10 p-4">
                        <p class="text-2xl font-bold text-[#d8b4fe]">+500</p>
                        <p class="text-sm text-white/70 mt-1">Pacientes</p>
                    </div>
                    <div class="rounded-2xl bg-white/10 border border-white/10 p-4">
                        <p class="text-2xl font-bold text-[#7dd3fc]">100%</p>
                        <p class="text-sm text-white/70 mt-1">Control</p>
                    </div>
                </div>
            </section>

            {{-- Panel login --}}
            <section class="flex items-center justify-center">
                <div class="w-full max-w-md rounded-[2rem] bg-white/80 backdrop-blur-xl shadow-[0_20px_60px_rgba(15,23,42,0.12)] border border-white p-8 sm:p-10">

                    <div class="flex justify-center mb-6">
                        <img
                                    src="{{ asset('images/logo.png') }}"
                                    alt="Logo"
                                    class="h-9 w-auto"
                                >
                    </div>

                    <div class="text-center mb-8">
                        <h3 class="text-3xl font-extrabold text-gray-900">Iniciar sesión</h3>
                        <p class="mt-2 text-sm text-gray-500">Ingresa tus datos para continuar</p>
                    </div>

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

                        <div>
                            <x-input-label for="email" :value="__('Correo electrónico')" class="text-sm font-semibold text-gray-700" />
                            <x-text-input
                                id="email"
                                class="block mt-2 w-full rounded-2xl border-gray-200 focus:border-[#008b8f] focus:ring-[#008b8f]"
                                type="email"
                                name="email"
                                :value="old('email')"
                                placeholder="correo@ejemplo.com"
                                required
                                autofocus
                                autocomplete="username"
                            />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="password" :value="__('Contraseña')" class="text-sm font-semibold text-gray-700" />
                            <x-text-input
                                id="password"
                                class="block mt-2 w-full rounded-2xl border-gray-200 focus:border-[#008b8f] focus:ring-[#008b8f]"
                                type="password"
                                name="password"
                                placeholder="••••••••"
                                required
                                autocomplete="current-password"
                            />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-between gap-4">
                            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                                <input
                                    id="remember_me"
                                    type="checkbox"
                                    class="rounded border-gray-300 text-[#008b8f] shadow-sm focus:ring-[#008b8f]"
                                    name="remember"
                                >
                                <span class="ms-2 text-sm text-gray-600">Recordarme</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a class="text-sm font-medium text-[#008b8f] hover:text-[#007378] transition" href="{{ route('password.request') }}">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            @endif
                        </div>

                        <x-primary-button class="w-full justify-center py-3.5 rounded-2xl bg-[#008b8f] hover:bg-[#007378] focus:ring-[#008b8f]">
                            {{ __('Ingresar') }}
                        </x-primary-button>
                    </form>
                </div>
            </section>
        </div>
    </main>

</body>
</html>