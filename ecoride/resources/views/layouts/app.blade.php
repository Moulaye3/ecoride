<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EcoRide - Covoiturage Écologique')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-gray-50 font-sans">

    <!-- Navbar -->
    <nav class="bg-white border-b border-emerald-100 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-3 text-2xl font-bold text-emerald-700">
                    🌱 <span>EcoRide</span>
                </a>

                @auth
                    <div class="flex items-center gap-8 text-sm font-medium">
                        <a href="{{ route('rides.search') }}" class="hover:text-emerald-700">Rechercher</a>
                        <a href="{{ route('rides.index') }}" class="hover:text-emerald-700">Trajets</a>
                        <a href="{{ route('rides.history') }}" class="hover:text-emerald-700">Historique</a>
                        <a href="{{ route('vehicles.index') }}" class="hover:text-emerald-700">Véhicules</a>

                        <!-- Menu Admin / Employee -->
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}"
                                class="text-amber-600 font-semibold hover:text-amber-700">🔧 Admin</a>
                        @elseif(auth()->user()->role === 'employee')
                            <a href="{{ route('employee.dashboard') }}"
                                class="text-teal-600 font-semibold hover:text-teal-700">🛡️ Modération</a>
                        @endif
                    </div>

                    <!-- Profil Dropdown -->
                    <div class="flex items-center gap-4">
                        <span class="text-sm font-medium">{{ auth()->user()->pseudo }}</span>

                        <div class="relative group">
                            <div
                                class="w-9 h-9 bg-emerald-100 rounded-2xl flex items-center justify-center cursor-pointer text-xl">
                                👤
                            </div>
                            <div
                                class="absolute right-0 mt-2 w-52 bg-white rounded-3xl shadow-xl py-2 border border-gray-100 hidden group-hover:block">
                                <a href="{{ route('dashboard') }}" class="block px-6 py-3 hover:bg-emerald-50">Dashboard</a>
                                <a href="{{ route('profile.edit') }}" class="block px-6 py-3 hover:bg-emerald-50">Mon
                                    Profil</a>
                                <form method="POST" action="{{ route('logout') }}" class="block">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-6 py-3 hover:bg-red-50 text-red-600">Déconnexion</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex gap-4">
                        <a href="{{ route('login') }}" class="font-medium">Connexion</a>
                        <a href="{{ route('register') }}"
                            class="bg-emerald-600 text-white px-6 py-2.5 rounded-2xl">Inscription</a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main>
        @yield('content')
    </main>

    <!-- Messages flash -->
    @if (session('success'))
        <div class="fixed bottom-6 right-6 bg-emerald-600 text-white px-8 py-4 rounded-3xl shadow-2xl">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="fixed bottom-6 right-6 bg-red-600 text-white px-8 py-4 rounded-3xl shadow-2xl">
            {{ session('error') }}
        </div>
    @endif

</body>

</html>