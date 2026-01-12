<?php

namespace App\Livewire\dashboard;

use Livewire\Component;
use App\Models\Actividades;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use App\Models\Servicos as Servico;

class Servicos extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap'; // 🔥 Muito importante

    public $nome;
    public $descricao;
    public $preco;
    public $duracao;
    public $tipo_cobranca;
    public $ativo;
    public $servicos;
    public $servicoId;

    // Modal
     public $nomeModal;
    public $descricaoModal;
    public $precoModal;
    public $duracaoModal;
    public $tipo_cobrancaModal;
    public $ativoModal;
    public $servicosModal;
    public $servicoIdModal;

    public function render()
    {

        $servicos = Servico::where('user_id', Auth::id())->paginate(5);
        return view('dashboard.servicos',['servicos' => $servicos])->layout('components.dashboard');
    }

    protected $rules = [
        'nome' => 'required|string|min:1',
        'descricao' => 'nullable|string',
        'preco' => 'required|numeric',
        'tipo_cobranca' => 'required|string',
        'ativo' => 'boolean',
        'duracao' => 'numeric|nullable'
    ];

    public function Salvar()
    {

        $this->validate();

        Servico::create([
           'nome' => $this->nome,
           'descricao' => $this->descricao,
           'preco' => $this->preco,
           'tipo_cobranca' => $this->tipo_cobranca,
           'ativo' => $this->ativo,
           'duracao' => $this->duracao,
           'user_id' => Auth::id()
        ]);

        $this->dispatch('swal', [
        'title' => 'Sucesso!',
        'text' => 'Serviço cadastrado com sucesso ',
        'icon' => 'success',
        ]);


         Actividades::create([
            'responsavel' => Auth::id(),
            'tipoActividade' => 'Cadastro',
            'descricao' => 'Criação de um Serviço'
        ]);



        $this->resetForm();
    }

    public function edit($id)
    {
       $servico = Servico::findOrFail($id);

        $this->servicoId = $servico->id;
        $this->nomeModal = $servico->nome;
        $this->descricaoModal = $servico->descricao;
        $this->tipo_cobrancaModal = $servico->tipo_cobranca;
        $this->precoModal = $servico->preco;
        $this->ativoModal = $servico->ativo;
        $this->duracaoModal = $servico->duracao;

        $this->dispatch('openModal', ['modalId' => 'edite']);
    }

     public function Atualizar()
    {

        try {
            $servico = Servico::find($this->servicoId);


           $servico->nome = $this->nomeModal ?? $servico->nome;
            $servico->descricao =  $this->descricaoModal ?? $servico->descricao;
            $servico->tipo_cobranca =  $this->tipo_cobrancaModal ?? $servico->tipo_cobranca;
            $servico->preco =  $this->precoModal ?? $servico->preco;
            $servico->ativo =  $this->ativoModal ?? $servico->ativo;
            $servico->duracao =  $this->duracaoModal ?? $servico->duracao;

            $servico->save();

            Actividades::create([
                'responsavel' => Auth::id(),
                'tipoActividade' => 'Edição',
                'descricao' => 'Editação de um Serviço'
            ]);

            $this->dispatch('swal', [
            'title' => 'Sucesso!',
            'text' => 'Serviço Editado com sucesso ',
            'icon' => 'success',
            ]);

            $this->reset([
                'nome',
                'descricao',
                'preco',
                'ativo',
                'duracao'
            ]);




        $this->dispatch('closeModal', ['modalId' => 'edite']);

        $this->resetForm();
        } catch (\Throwable $th) {
             $this->dispatch('swal', [
        'title' => 'Erro ao Editar!',
        'text' => 'Erro: ' . $th->getMessage(),
        'icon' => 'error',
        ]);

        }
    }

    public function delete($id){
        $servico = Servico::findOrFail($id);
        $servico->delete();

        $this->dispatch('swal', [
        'title' => 'Sucesso!',
        'text' => 'Serviço Deletado com sucesso ',
        'icon' => 'success',
        ]);

    }

    public function resetForm()
    {
        $this->reset(['nome', 'descricao', 'preco', 'tipo_cobranca', 'ativo', 'duracao']);
    }
}


