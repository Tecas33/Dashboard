<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // app/Http/Controllers/DashboardController.php

    public function index()
    {
        $user = auth()->user();

        // Estatísticas
        $totalProjects = $user->projects()->count();
        $totalTasks = $user->tasks()->count();
        $pendingTasks = $user->tasks()->where('is_completed', false)->count();
        $completedTasks = $user->tasks()->where('is_completed', true)->count();

        // Cálculo de progresso (evitando divisão por zero)
        $progress = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

        // Últimas tarefas para dar um ar profissional
        $recentTasks = $user->tasks()->latest()->take(5)->get();

        return view('home', compact(
            'totalProjects',
            'totalTasks',
            'pendingTasks',
            'progress',
            'recentTasks'
        ));
    }
}
