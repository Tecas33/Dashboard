@extends('dashboar')

@section('content')
    <div class="max-w-5xl mx-auto space-y-8">

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white">Minhas Tarefas</h2>
                <p class="text-gray-500 dark:text-gray-400">Organize suas atividades e vincule-as aos seus projetos.</p>
            </div>
            <div class="bg-blue-100 text-blue-700 px-4 py-2 rounded-xl text-sm font-bold shadow-sm">
                {{ $tasks->where('is_completed', false)->count() }} tarefas pendentes
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold uppercase text-gray-400 mb-1 ml-1">O que precisa ser
                            feito?</label>
                        <input type="text" name="title" placeholder="Ex: Finalizar interface do dashboard" required
                            class="w-full px-4 py-2 rounded-xl border border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-400 mb-1 ml-1">Projeto</label>
                        <select name="project_id" required
                            class="w-full px-4 py-2 rounded-xl border border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all text-sm">
                            <option value="">Selecionar Projeto...</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold uppercase text-gray-400 mb-1 ml-1">Descrição
                            (Opcional)</label>
                        <input type="text" name="description" placeholder="Algum detalhe extra?"
                            class="w-full px-4 py-2 rounded-xl border border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block text-xs font-bold uppercase text-gray-400 mb-1 ml-1">Prazo</label>
                            <input type="date" name="due_date"
                                class="w-full px-4 py-2 rounded-xl border border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all text-sm">
                        </div>
                        <div class="flex items-end">
                            <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-xl font-bold transition-all transform hover:scale-[1.02] active:scale-95 shadow-lg">
                                Criar
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div
            class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
            @forelse($tasks as $task)
                <div
                    class="flex items-center justify-between p-5 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors border-b border-gray-100 dark:border-gray-700 last:border-0 group">
                    <div class="flex items-center gap-4 flex-1">
                        <form action="{{ route('tasks.toggle', $task) }}" method="POST">
                            @csrf @method('PATCH')
                            <input type="checkbox" onChange="this.form.submit()" {{ $task->is_completed ? 'checked' : '' }}
                                class="w-6 h-6 rounded-lg border-gray-300 text-blue-600 focus:ring-blue-500 cursor-pointer">
                        </form>

                        <div class="flex flex-col">
                            <div class="flex items-center gap-2">
                                <span
                                    class="text-lg font-semibold {{ $task->is_completed ? 'line-through text-gray-400' : 'text-gray-800 dark:text-white' }}">
                                    {{ $task->title }}
                                </span>
                                <span
                                    class="px-2 py-0.5 text-[10px] font-black uppercase bg-blue-50 text-blue-600 rounded-md">
                                    {{ $task->project->name ?? 'Geral' }}
                                </span>
                            </div>
                            @if ($task->description)
                                <p class="text-sm text-gray-500 italic">"{{ $task->description }}"</p>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                        @if (!$task->is_completed)
                            <button onclick="openEditTaskModal({{ json_encode($task) }})"
                                class="text-gray-400 hover:text-blue-500 p-2 rounded-lg hover:bg-blue-50 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                            </button>
                        @endif

                        <button type="button" onclick="confirmDeleteTask({{ $task->id }})"
                            class="text-gray-400 hover:text-red-500 p-2 rounded-lg transition-colors hover:bg-red-50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                        </button>
                        <form id="delete-task-{{ $task->id }}" action="{{ route('tasks.destroy', $task) }}"
                            method="POST" class="hidden">
                            @csrf @method('DELETE')
                        </form>
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center p-8 text-center">
                    <div
                        class="inline-flex items-center justify-center w-24 h-24 mb-6 bg-blue-50 dark:bg-gray-700 rounded-full">
                        <svg class="w-12 h-12 text-blue-500 dark:text-blue-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Nada por aqui ainda!</h3>
                    <p class="text-gray-500 dark:text-gray-400 max-w-lg mx-auto">
                        Parece que você  ainda não começou. Que tal criar uma nova tarefa agora?
                    </p>
                </div>
            @endforelse
        </div>
    </div>

    <div id="editTaskModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="closeEditTaskModal()"></div>
            <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-lg w-full p-8">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-6">Editar Tarefa</h3>
                <form id="editTaskForm" method="POST" class="space-y-4">
                    @csrf @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título</label>
                        <input type="text" id="edit_task_title" name="title" required
                            class="w-full mt-1 px-4 py-2 border rounded-xl dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Projeto</label>
                        <select id="edit_task_project" name="project_id" required
                            class="w-full mt-1 px-4 py-2 border rounded-xl dark:bg-gray-700 dark:text-white">
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descrição</label>
                        <textarea id="edit_task_description" name="description"
                            class="w-full mt-1 px-4 py-2 border rounded-xl dark:bg-gray-700 dark:text-white"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Prazo</label>
                        <input type="date" id="edit_task_due_date" name="due_date"
                            class="w-full mt-1 px-4 py-2 border rounded-xl dark:bg-gray-700 dark:text-white">
                    </div>
                    <div class="flex justify-end gap-3 pt-4">
                        <button type="button" onclick="closeEditTaskModal()"
                            class="px-4 py-2 text-gray-500 hover:bg-gray-100 rounded-xl">Cancelar</button>
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700">Salvar
                            Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openEditTaskModal(task) {
            const form = document.getElementById('editTaskForm');
            form.action = `/tarefas/${task.id}`; // Ajuste conforme sua rota de update

            document.getElementById('edit_task_title').value = task.title;
            document.getElementById('edit_task_project').value = task.project_id;
            document.getElementById('edit_task_description').value = task.description || '';
            document.getElementById('edit_task_due_date').value = task.due_date ? task.due_date.split(' ')[0] : '';

            document.getElementById('editTaskModal').classList.remove('hidden');
        }

        function closeEditTaskModal() {
            document.getElementById('editTaskModal').classList.add('hidden');
        }

        function confirmDeleteTask(taskId) {
            Swal.fire({
                title: 'Excluir tarefa?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                confirmButtonText: 'Sim, excluir',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-task-' + taskId).submit();
                }
            })
        }
    </script>
@endsection
