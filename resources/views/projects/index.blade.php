@extends('dashboar')

@section('content')
<div class="max-w-6xl mx-auto space-y-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 dark:text-white">Meus Projetos</h2>
            <p class="text-gray-500 dark:text-gray-400">Gerencie seus fluxos de trabalho e acompanhe o progresso.</p>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="p-6 border-b border-gray-50 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-700/30">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Criar Novo Projeto</h3>
        </div>
        <div class="p-6">
            <form action="{{ route('projects.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @csrf
                <div class="md:col-span-2 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nome do Projeto</label>
                        <input type="text" name="name" placeholder="Ex: Redesign do Site" required
                            class="w-full px-4 py-2 rounded-xl border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Descrição</label>
                        <textarea name="description" rows="1" placeholder="Breve resumo do projeto..."
                            class="w-full px-4 py-2 rounded-xl border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all"></textarea>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status Inicial</label>
                        <select name="status" class="w-full px-4 py-2 rounded-xl border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                            <option value="active">Ativo</option>
                            <option value="on_hold">Em espera</option>
                            <option value="completed">Concluído</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full h-[42px] mt-6 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-blue-200 dark:shadow-none transform hover:-translate-y-1">
                        Criar Projeto
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700/50">
                        <th class="px-6 py-4 text-xs font-bold uppercase text-gray-400">Projeto</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase text-gray-400 text-center">Status</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase text-gray-400 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse ($projects as $project)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/30 transition-colors">
                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-800 dark:text-white">{{ $project->name }}</p>
                                <p class="text-xs text-gray-500 truncate max-w-[300px]">{{ $project->description }}</p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full text-xs font-bold
                                    {{ $project->status == 'active' ? 'bg-green-100 text-green-700' : ($project->status == 'completed' ? 'bg-blue-100 text-blue-700' : 'bg-amber-100 text-amber-700') }}">
                                    {{ $project->status == 'active' ? 'Ativo' : ($project->status == 'completed' ? 'Concluído' : 'Em Espera') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right flex justify-end gap-2">
                                <button onclick="openEditProjectModal({{ json_encode($project) }})" class="text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/30 p-2 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                                <form id="delete-project-{{ $project->id }}" action="{{ route('projects.destroy', $project) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmDeleteProject({{ $project->id }})" class="text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 p-2 rounded-lg transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-gray-500">Nenhum projeto encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="editProjectModal" class="fixed inset-0 z-[60] hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm" onclick="closeEditProjectModal()"></div>
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-md p-6 relative z-10">
            <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Editar Projeto</h3>
            <form id="editProjectForm" method="POST">
                @csrf @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nome</label>
                        <input type="text" id="edit_name" name="name" required class="w-full px-4 py-2 rounded-xl border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descrição</label>
                        <textarea id="edit_description" name="description" rows="3" class="w-full px-4 py-2 rounded-xl border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                        <select id="edit_status" name="status" class="w-full px-4 py-2 rounded-xl border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="active">Ativo</option>
                            <option value="on_hold">Em espera</option>
                            <option value="completed">Concluído</option>
                        </select>
                    </div>
                    <div class="flex gap-3 pt-4">
                        <button type="button" onclick="closeEditProjectModal()" class="flex-1 px-4 py-2 bg-gray-100 text-gray-600 font-semibold rounded-xl">Cancelar</button>
                        <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white font-semibold rounded-xl shadow-lg">Salvar Alterações</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openEditProjectModal(project) {
        const form = document.getElementById('editProjectForm');
        form.action = `/projects/${project.id}`; // Verifique se sua rota é esta

        document.getElementById('edit_name').value = project.name;
        document.getElementById('edit_description').value = project.description || '';
        document.getElementById('edit_status').value = project.status;

        document.getElementById('editProjectModal').classList.remove('hidden');
    }

    function closeEditProjectModal() {
        document.getElementById('editProjectModal').classList.add('hidden');
    }

    function confirmDeleteProject(projectId) {
        Swal.fire({
            title: 'Excluir projeto?',
            text: "Todas as tarefas vinculadas serão perdidas!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            confirmButtonText: 'Sim, excluir',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-project-' + projectId).submit();
            }
        })
    }
</script>
@endsection
