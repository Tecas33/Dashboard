@extends('dashboar')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    <div>
        <h2 class="text-3xl font-bold text-gray-800 dark:text-white">Olá, {{ auth()->user()->name }}! 👋</h2>
        <p class="text-gray-500 dark:text-gray-400">Aqui está o resumo da sua produtividade hoje.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-blue-100 text-blue-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2z"></path></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Projetos Ativos</p>
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalProjects }}</h3>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-amber-100 text-amber-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Tarefas Pendentes</p>
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $pendingTasks }}</h3>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 md:col-span-2">
            <div class="flex justify-between items-center mb-4">
                <p class="text-sm text-gray-500 font-medium">Progresso Geral das Tarefas</p>
                <span class="text-sm font-bold text-blue-600">{{ $progress }}%</span>
            </div>
            <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-3">
                <div class="bg-blue-600 h-3 rounded-full transition-all duration-1000" style="width: {{ $progress }}%"></div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div class="p-6 border-b border-gray-50 dark:border-gray-700 flex justify-between items-center">
                <h3 class="font-bold text-gray-800 dark:text-white text-lg">Últimas Tarefas Criadas</h3>
                <a href="{{ route('tasks.index') }}" class="text-sm text-blue-600 hover:underline">Ver todas</a>
            </div>
            <div class="divide-y divide-gray-50 dark:divide-gray-700">
                @forelse($recentTasks as $task)
                <div class="p-4 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full {{ $task->is_completed ? 'bg-green-500' : 'bg-blue-500' }}"></div>
                        <span class="text-gray-700 dark:text-gray-300 font-medium">{{ $task->title }}</span>
                    </div>
                    <span class="text-xs text-gray-400">{{ $task->created_at->diffForHumans() }}</span>
                </div>
                @empty
                <p class="p-8 text-center text-gray-400">Nenhuma tarefa recente encontrada.</p>
                @endforelse
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-gradient-to-br from-blue-600 to-blue-700 p-6 rounded-2xl shadow-lg text-white">
                <h3 class="font-bold text-lg mb-2">Novo Projeto?</h3>
                <p class="text-blue-100 text-sm mb-4">Organize seus clientes e demandas em pastas separadas.</p>
                <a href="{{ route('projects.index') }}" class="inline-block w-full text-center bg-white text-blue-600 font-bold py-2 rounded-xl hover:bg-blue-50 transition-colors">
                    Criar Projeto
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                <h3 class="font-bold text-gray-800 dark:text-white mb-4">Atalhos</h3>
                <div class="space-y-3">
                    <a href="{{ route('tasks.index') }}" class="flex items-center gap-3 text-gray-600 dark:text-gray-300 hover:text-blue-600 transition-colors">
                        <div class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-gray-700 flex items-center justify-center">🚀</div>
                        Nova Tarefa
                    </a>
                    <hr class="dark:border-gray-700">
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 text-gray-600 dark:text-gray-300 hover:text-blue-600 transition-colors">
                        <div class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-gray-700 flex items-center justify-center">⚙️</div>
                        Configurações
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
