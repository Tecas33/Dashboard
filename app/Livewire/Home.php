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

     public function mount()
    {
        $this->user = Auth::user();
        $this->CountServicos = $this->user = Servicos::where('user_id', Auth::id())->count();
        $this->CountProdutos = $this->user = Produtos::where('user_id', Auth::id())->count();
        $this->CountClientes = $this->user = Clientes::where('user_id', Auth::id())->count();
    }

    public function render()
    {
        // $this->CountClientes = Clientes::count();
        // $this->CountProdutos= Produtos::count();
        // $this->CountServicos= Servicos::count();

        $this->CountActividades = Actividades::with('user') ->orderBy('created_at', 'desc')->take(5)->get();
        return view('components.home', ['CountActividades' => $this->CountActividades])->layout('components.dashboard');
    }

    public function disparar()
    {
        dd("ageu e maio no beck end");
    }
}
