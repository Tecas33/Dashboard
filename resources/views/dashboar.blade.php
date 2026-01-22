<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow - Gestão</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Transição suave para o menu lateral mobile */
        #mobile-sidebar {
            transition: transform 0.3s ease-in-out;
        }
        /* Garante que a sidebar desktop ocupe a altura toda */
        aside {
            height: 100vh;
        }
    </style>
</head>

<body class="bg-gray-50 dark:bg-gray-900 antialiased">
    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 hidden md:flex flex-col flex-shrink-0">
            <div class="p-6 flex items-center gap-2 flex-shrink-0">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold">T</div>
                <h1 class="text-xl font-bold text-gray-800 dark:text-white">TaskFlow</h1>
            </div>

            <nav class="flex-1 flex flex-col px-4 pb-4 overflow-y-auto">
                <div class="space-y-2 mt-4">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 p-3 text-sm font-medium rounded-xl transition-all {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('projects.index') }}" class="flex items-center gap-3 p-3 text-sm font-medium rounded-xl transition-all {{ request()->routeIs('projects.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                        Meus Projetos
                    </a>
                    <a href="{{ route('tasks.index') }}" class="flex items-center gap-3 p-3 text-sm font-medium rounded-xl transition-all {{ request()->routeIs('tasks.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        Tarefas
                    </a>
                </div>

                <div class="mt-auto pt-10 space-y-2 flex-shrink-0">
                    <hr class="border-gray-100 dark:border-gray-700 mb-4">
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 p-3 text-sm font-medium rounded-xl transition-all {{ request()->routeIs('profile.edit') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Configurações de Perfil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-3 p-3 w-full text-sm font-medium text-red-600 hover:bg-red-50 rounded-xl transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Sair
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        <div id="mobile-menu-container" class="fixed inset-0 z-50 md:hidden hidden">
            <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" onclick="toggleMenu()"></div>

            <aside id="mobile-sidebar" class="absolute left-0 top-0 w-72 h-full bg-white dark:bg-gray-800 shadow-2xl flex flex-col p-6 transform -translate-x-full">
                <div class="flex items-center justify-between mb-8 flex-shrink-0">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold">T</div>
                        <h1 class="text-xl font-bold text-gray-800 dark:text-white">TaskFlow</h1>
                    </div>
                    <button onclick="toggleMenu()" class="text-gray-500 p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <nav class="flex-1 space-y-2 overflow-y-auto">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 p-3 text-sm font-medium rounded-xl text-gray-600 dark:text-gray-300">
                        Dashboard
                    </a>
                    <a href="{{ route('projects.index') }}" class="flex items-center gap-3 p-3 text-sm font-medium rounded-xl text-gray-600 dark:text-gray-300">
                        Meus Projetos
                    </a>
                    <a href="{{ route('tasks.index') }}" class="flex items-center gap-3 p-3 text-sm font-medium rounded-xl text-gray-600 dark:text-gray-300">
                        Tarefas
                    </a>
                </nav>

                <div class="mt-auto pt-6 space-y-2 flex-shrink-0">
                    <hr class="border-gray-100 dark:border-gray-700 mb-4">
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 p-3 text-sm font-medium rounded-xl text-gray-600 dark:text-gray-300">
                        Configurações de Perfil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-3 p-3 w-full text-sm font-medium text-red-600">
                            Sair
                        </button>
                    </form>
                </div>
            </aside>
        </div>

        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 h-16 flex items-center justify-between px-4 md:px-8 flex-shrink-0">
                <div class="flex items-center gap-4">
                    <button onclick="toggleMenu()" class="p-2 rounded-lg text-gray-600 hover:bg-gray-100 dark:text-gray-300 md:hidden">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <span class="text-blue-600 font-bold text-xl">TaskFlow</span>
                </div>

                <a href="{{ route('profile.edit') }}" class="flex items-center gap-4 group cursor-pointer">
                    <span class="text-sm font-semibold text-gray-800 dark:text-white hidden sm:block">{{ Auth::user()->name }}</span>
                    <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold group-hover:ring-4 ring-blue-100 transition-all">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </a>
            </header>

            <main class="flex-1 overflow-y-auto p-4 md:p-8">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Lógica para Abrir/Fechar Menu Mobile
        function toggleMenu() {
            const container = document.getElementById('mobile-menu-container');
            const sidebar = document.getElementById('mobile-sidebar');

            if (container.classList.contains('hidden')) {
                container.classList.remove('hidden');
                setTimeout(() => {
                    sidebar.classList.remove('-translate-x-full');
                }, 10);
            } else {
                sidebar.classList.add('-translate-x-full');
                setTimeout(() => {
                    container.classList.add('hidden');
                }, 300);
            }
        }

        // Script para SweetAlert2 (Sucesso do Laravel)
        @if (session('success'))
            Swal.fire({
                title: 'Sucesso!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonColor: '#2563eb',
                confirmButtonText: 'Ok',
                customClass: {
                    popup: 'rounded-2xl'
                }
            });
        @endif
    </script>
</body>
</html>
