<?php

namespace App\Livewire\dashboard;
use Livewire\WithFileUploads;
use App\Models\Produtos as Produto;
use App\Models\Actividades;
use Illuminate\Support\Facades\Auth;
use App\Models\Clientes;

use Livewire\Component;

class Produtos extends Component
{
    use WithFileUploads; // Para upload de imagens

    public $nome;
    public $categoria;
    public $sku;
    public $descricao;
    public $cliente_id;
    public $preco;
    public $preco_promocional;
    public $stock;
    public $activo;
    public $imagem;
    public $clientes = [];
    public $produtos;

    public function render()
    {
        $this->clientes = Clientes::where('ativo', true)->get();
        $this->produtos = Produto::where('user_id', Auth::id())->get();
        return view('dashboard.produtos', ['produtos' => $this->produtos, 
        'clientes' => $this->clientes,])->layout('components.dashboard');
    }

     // Validação
    protected $rules = [
        'nome' => 'required|string|max:255',
        'sku' => 'required|string|unique:produtos,sku',
        'categoria' => 'nullable|string|max:100',
        'preco' => 'required|numeric|min:0',
        'preco_promocional' => 'nullable|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'descricao' => 'nullable|string',
        'imagem' => 'nullable|image|max:2048',
        'activo' => 'boolean',
        'cliente_id' => 'required|exists:clientes,id',
    ];

    public function save()
    {
        $this->validate();

        $imagemPath = $this->imagem ? $this->imagem->store('produtos', 'public') : null;

        Produto::create([
            'nome' => $this->nome,
            'sku' => $this->sku,
            'categoria' => $this->categoria,
            'preco' => $this->preco,
            'preco_promocional' => $this->preco_promocional,
            'stock' => $this->stock,
            'descricao' => $this->descricao,
            'imagem' => $imagemPath,
            'activo' => $this->activo,
            'cliente_id' => $this->cliente_id,
            'user_id' => Auth::id()
        ]);

        //     Auth::user()->notify(
        //     new NovoRegistro('Produto criado com sucesso!')
        // );


         Actividades::create([
            'responsavel' => Auth::id(),
            'tipoActividade' => 'Cadastro',
            'descricao' => 'Criação de um Produto'
        ]);

        $this->dispatch('swal', [
        'title' => 'Sucesso!',
        'text' => 'Produto cadastrado com sucesso ',
        'icon' => 'success',
        ]);

         

        // Limpar campos
        $this->reset([
            'nome',
            'sku',
            'preco',
            'categoria',
            'imagem',
            'activo',
            'cliente_id',
            'descricao',
            'stock',
            'imagem',
            'preco_promocional'
        ]);
    }
}
