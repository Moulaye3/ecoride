<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EcoRide') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-emerald-50">
    <div class="min-h-screen flex flex-col">

        <!-- Navbar simplifiée pour les invités -->
        <nav class="bg-white border-b border-emerald-100">
            <div class="max-w-7xl mx-auto px-6 py-4">
                <div class="flex justify-between items-center">
                    <a href="/" class="flex items-center gap-3 text-2xl font-bold text-emerald-700">
                        🌱 EcoRide
                    </a>

                    <div class="flex gap-6">
                        <a href="{{ route('login') }}"
                            class="font-medium text-gray-700 hover:text-emerald-700">Connexion</a>
                        <a href="{{ route('register') }}"
                            class="bg-emerald-600 text-white px-6 py-2.5 rounded-2xl font-medium hover:bg-emerald-700">
                            Inscription
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Contenu principal -->
        <main class="flex-1">
            {{ $slot }}
        </main>

    </div>
</body>

</html>