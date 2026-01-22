<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Lista todos os projetos do usuário logado.
     */
    public function index()
    {
        $projects = auth()->user()->projects()->latest()->get();
        return view('projects.index', compact('projects'));
    }

    /**
     * Mostra o formulário de criação (se necessário).
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Salva um novo projeto vinculado ao usuário.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,completed,on_hold',
        ]);

        auth()->user()->projects()->create($data);

        return redirect()->route('projects.index')->with('success', 'Projeto criado com sucesso!');
    }

    /**
     * Mostra um projeto específico.
     */
    public function show(Project $project)
    {
        // Bloqueia acesso se o projeto não for do usuário
        $this->authorizeUser($project);

        return view('projects.show', compact('project'));
    }

    /**
     * Edita um projeto existente.
     */
    public function edit(Project $project)
    {
        $this->authorizeUser($project);

        return view('projects.edit', compact('project'));
    }

    /**
     * Atualiza os dados no banco.
     */
    public function update(Request $request, Project $project)
    {
        $this->authorizeUser($project);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,completed,on_hold',
        ]);

        $project->update($data);

        return redirect()->route('projects.index')->with('success', 'Projeto atualizado!');
    }

    /**
     * Exclui o projeto.
     */
    public function destroy(Project $project)
    {
        $this->authorizeUser($project);

        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Projeto removido!');
    }

    /**
     * Método auxiliar para evitar repetição de código (DRY).
     */
    private function authorizeUser(Project $project)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403, 'Você não tem permissão para acessar este projeto.');
        }
    }
}
