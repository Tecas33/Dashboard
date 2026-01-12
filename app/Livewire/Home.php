<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Clientes;
use App\Models\Servicos;
use Illuminate\Support\Facades\Auth;
use App\Models\Produtos;
use App\Models\Actividades;
use App\Models\User;
use Livewire\WithPagination;


class Home extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $CountClientes;
    public $CountProdutos;
    public $CountServicos;
    public $CountActividades;
    public $user;

    public $tipoActividade;
    public $responsavel;
    public $descricao;
    public $user_id;



     public function mount()
    {
       $this->user = Auth::user(); // mantém o usuário autenticado

    $this->CountServicos = Servicos::where('user_id', Auth::id())->count();
    $this->CountProdutos = Produtos::where('user_id', Auth::id())->count();
    $this->CountClientes = Clientes::where('user_id', Auth::id())->count();
    }

    public function render()
    {
        // $this->CountClientes = Clientes::count();
        // $this->CountProdutos= Produtos::count();
        // $this->CountServicos= Servicos::count();

        $this->CountActividades = Actividades::with('user') ->orderBy('created_at', 'desc')->take(5)->get();
        return view('components.home', ['CountActividades' => $this->CountActividades])->layout('components.dashboard');
    }

    public function openModal($id)
    {
        $atividade = Actividades::findOrFail($id);
        $this->tipoActividade = $atividade->tipoActividade;
        $this->descricao = $atividade->descricao;
        $this->user_id = $atividade->user_id;

         $this->responsavel = $atividade->user->name ?? 'Sem responsável';

        $this->dispatch('openModal', ['modalId' => 'edite']);
    }
}
