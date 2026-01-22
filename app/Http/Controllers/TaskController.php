<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Lista as tarefas do usuário logado.
     */
    public function index()
    {

        // Pega as tarefas do usuário, trazendo as não concluídas primeiro
        $tasks =auth()->user()->tasks()
        ->orderBy('is_completed', 'asc') // Antes estava 'completed'
        ->orderBy('created_at', 'desc')
        ->get();



        $projects = auth()->user()->projects()->get();

        return view('tasks.index', compact('tasks', 'projects'));
    }

    /**
     * Salva uma nova tarefa.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'project_id' => 'required|exists:projects,id',
        ]);

        // Cria a tarefa vinculada ao usuário autenticado
        auth()->user()->tasks()->create($data);

        return redirect()->route('tasks.index')->with('success', 'Tarefa criada com sucesso!');
    }

    /**
     * Exibe os detalhes de uma tarefa específica.
     */
    public function show(Task $task)
    {
        $this->authorizeUser($task);
        return view('tasks.show', compact('task'));
    }

    /**
     * Atualiza os dados da tarefa ou marca como concluída.
     */
    public function update(Request $request, Task $task)
    {
        $this->authorizeUser($task);

        $data = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'nullable|boolean',
            'due_date' => 'nullable|date',
        ]);

        $task->update($data);

        return redirect()->route('tasks.index')->with('success', 'Tarefa atualizada!');
    }

    /**
     * Alterna rapidamente o status de conclusão (Check/Uncheck).
     */
    public function toggle(Task $task)
    {
        $this->authorizeUser($task);

        $task->update([
            'is_completed' => !$task->completed
        ]);

        return redirect()->back();
    }

    /**
     * Remove a tarefa do banco de dados.
     */
    public function destroy(Task $task)
    {
        $this->authorizeUser($task);

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tarefa excluída!');
    }

    /**
     * Proteção de Segurança: Impede que usuários acessem tarefas alheias.
     */
    private function authorizeUser(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403, 'Acesso negado.');
        }
    }
}
