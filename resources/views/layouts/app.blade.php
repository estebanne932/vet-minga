<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- 💧 Watermark -->
    <style>
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            
            width: 400px;
            height: 400px;

            background-image: url('{{ asset('images/logo.png') }}');
            background-repeat: no-repeat;
            background-size: contain;
            background-position: center;

            opacity: 0.06;
            filter: grayscale(100%);

            z-index: 0;
            pointer-events: none;

        }


        .input {
            @apply w-full px-4 py-2.5 rounded-lg border border-gray-300 
                focus:ring-2 focus:ring-teal-500 focus:border-teal-500 
                outline-none transition text-sm bg-white;
        }

        .label {
            @apply text-sm font-medium text-gray-700 mb-1 block;
        }

        .section-title {
            @apply text-lg font-semibold text-gray-800 mb-4 border-b pb-2;
        }

        .sub-title {
            @apply text-sm font-semibold text-gray-600 mb-3 capitalize;
        }

        .dropdown {
            @apply absolute bg-white border w-full z-20 rounded-lg shadow mt-1;
        }


    </style>
</head>

<body class="font-sans antialiased">

   <div class="min-h-screen bg-gray-100 relative">

        <!-- 💧 Marca de agua -->
        <div class="absolute inset-0 flex items-center justify-center opacity-10 pointer-events-none z-0">
            <img src="{{ asset('images/logo.png') }}" class="w-[500px]">
        </div>

        <div class="relative z-10">
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset


            <main>
                
                {{ $slot }}
            </main>
        </div>

    </div>

<div id="alerts-container" class="fixed top-5 right-5 z-50 space-y-3 w-full max-w-sm">
    @if (session('success'))
        <div class="alert-toast rounded-xl border border-green-200 bg-green-50 px-4 py-3 shadow-lg text-green-800 flex items-start gap-3">
            <div class="mt-0.5 text-green-600">
                ✓
            </div>
            <div class="flex-1">
                <p class="font-semibold">Éxito</p>
                <p class="text-sm">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="alert-toast rounded-xl border border-red-200 bg-red-50 px-4 py-3 shadow-lg text-red-800 flex items-start gap-3">
            <div class="mt-0.5 text-red-600">
                !</div>
            <div class="flex-1">
                <p class="font-semibold">Error</p>
                <p class="text-sm">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="fixed top-5 right-5 z-50 max-w-sm w-full bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl shadow-lg">
            <p class="font-semibold mb-2">Revisa lo siguiente</p>
            <ul class="list-disc pl-5 text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const toasts = document.querySelectorAll('.alert-toast');

    toasts.forEach((toast) => {
        setTimeout(() => {
            toast.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
            toast.style.opacity = '0';
            toast.style.transform = 'translateY(-10px)';
        }, 3000);

        setTimeout(() => {
            toast.remove();
        }, 3500);
    });
});
</script>

</body>
</html>
