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
    public $activo = true;
    public $imagem;
    public $clientes = [];
    public $produtos;

    public $nomeModal;
    public $categoriaModal;
    public $skuModal;
    public $descricaoModal;
    public $cliente_idModal;
    public $precoModal;
    public $preco_promocionalModal;
    public $stockModal;
    public $activoModal = true;
    public $imagemModal;
    public $clientesModal = [];
    public $produtosModal;
    public $produtoId;

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

    public function abrirmodal($id)
    {
        $produtos = Produto::findOrFail($id);

        $this->produtoId  = $produtos->id;
        $this->nomeModal = $produtos->nome;
        $this->categoriaModal = $produtos->categoria;
        $this->skuModal = $produtos->sku;
        $this->descricaoModal = $produtos->descricao;
        $this->cliente_idModal = $produtos->cliente_id;
        $this->precoModal = $produtos->preco;
        $this->preco_promocionalModal = $produtos->preco_promocional;
        $this->stockModal = $produtos->stock;
        $this->activoModal = $produtos->activo;
        $this->imagemModal = $produtos->imagem;

        $this->dispatch('openModal', ['modalId' => 'edite']);

    }
        public function atualizar()
        {
            try {
                $produto = Produto::find($this->produtoId);

                $produto->nome = $this->nomeModal ?? $produto->nome;
                $produto->categoria = $this->categoriaModal ?? $produto->categoria;
                $produto->sku = $this->skuModal ?? $produto->sku;
                $produto->descricao = $this->descricaoModal ?? $produto->descricao;
                $produto->cliente_id = $this->cliente_idModal ?? $produto->cliente_id;
                $produto->preco = $this->precoModal ?? $produto->preco;
                $produto->preco_promocional = $this->preco_promocionalModal ?? $produto->preco_promocional;
                $produto->stock = $this->stockModal ?? $produto->stock;
                $produto->activo = $this->activoModal ?? $produto->activo;

                if ($this->imagemModal) {
                    $imagemPath = $this->imagemModal->store('produtos', 'public');
                    $produto->imagem = $imagemPath;
                }

                $produto->save();

                    Actividades::create([
                        'responsavel' => Auth::id(),
                        'tipoActividade' => 'Edição',
                        'descricao' => 'Edição de um Produto'
                    ]);



                $this->dispatch('swal', [
                    'title' => 'Sucesso!',
                    'text' => 'Produto atualizado com sucesso ',
                    'icon' => 'success',
                ]);

            } catch (\Exception $e) {
                $this->dispatch('swal', [
                    'title' => 'Erro!',
                    'text' => 'Ocorreu um erro ao atualizar o produto.',
                    'icon' => 'error',
                ]);
            }
         $this->dispatch('closeModal', ['modalId' => 'edite']);
    }
}
