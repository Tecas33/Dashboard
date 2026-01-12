<?php

namespace App\Livewire\dashboard;
use App\Models\Clientes as Cliente;
use App\Models\Actividades;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\Component;

class Clientes extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap'; // 🔥 Muito importante

    // public $clientes;
    public $nome, $email, $telefone, $tipo = 'PF', $documento, $empresa, $endereco, $ativo = true;
    public $clienteId = null;
    public $nomeModal, $emailModal, $telefoneModal, $tipoModal = 'PF', $documentoModal, $empresaModal, $enderecoModal, $ativoModal = true;

    public function render()
    {
        // $clientes = Cliente::where('user_id', Auth::id())->paginate(5);
        return view('dashboard.clientes', ['clientes' =>  Cliente::where('user_id', Auth::id())->paginate(5)])->layout('components.dashboard');
    }



    protected $rules = [
        'nome' => 'required|string|min:1',
        'email' => 'nullable|email',
        'telefone' => 'nullable|string',
        'tipo' => 'required|in:PF,PJ',
        'documento' => 'nullable|string',
        'empresa' => 'nullable|string',
        'endereco' => 'nullable|string',
        'ativo' => 'boolean',
    ];

    // public function mount()
    // {
    //     $this->clientes = Cliente::all();
    // }


    public function Salvar()
    {
        $this->validate();

        Cliente::create(
            // ['id' => $this->clienteId],
            [
                'nome' => $this->nome,
                'email' => $this->email,
                'telefone' => $this->telefone,
                'tipo' => $this->tipo,
                'documento' => $this->documento,
                'empresa' => $this->empresa,
                'endereco' => $this->endereco,
                'ativo' => $this->ativo,
                'user_id' => Auth::id()
            ]
        );

        $this->dispatch('swal', [
        'title' => 'Sucesso!',
        'text' => 'Cliente cadastrado com sucesso ',
        'icon' => 'success',
        ]);

        Actividades::create([
            'responsavel' => Auth::id(),
            'tipoActividade' => 'Cadastro',
            'descricao' => 'Criação de um clientes'
        ]);




        $this->resetForm();
    }

      public function resetForm()
    {
        $this->reset(['nome', 'email', 'telefone', 'tipo', 'documento', 'empresa', 'endereco', 'ativo', 'clienteId']);
    }


    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        $this->clienteId = $cliente->id;
        $this->nomeModal = $cliente->nome;
        $this->emailModal = $cliente->email;
        $this->telefoneModal = $cliente->telefone;
        $this->tipoModal = $cliente->tipo;
        $this->documentoModal = $cliente->documento;
        $this->empresaModal = $cliente->empresa;
        $this->enderecoModal = $cliente->endereco;
        $this->ativoModal = $cliente->ativo;

        $this->dispatch('openModal', ['modalId' => 'edite']);
    }

    public function Atualizar()
    {
        $cliente = Cliente::find($this->clienteId);

        $cliente->nome = $this->nomeModal ?? $cliente->nome;
        $cliente->email = $this->emailModal  ?? $cliente->email;
        $cliente->telefone = $this->telefoneModal  ?? $cliente->telefone;
        $cliente->tipo = $this->tipoModal  ?? $cliente->tipo;
        $cliente->documento = $this->documentoModal  ?? $cliente->documento;
        $cliente->endereco = $this->enderecoModal  ?? $cliente->endereco;
        $cliente->empresa = $this->empresaModal  ?? $cliente->empresa;
        $cliente->ativo = $this->ativoModal  ?? $cliente->ativo;

        $cliente->save();

         Actividades::create([
                'responsavel' => Auth::id(),
                'tipoActividade' => 'Edição',
                'descricao' => 'Editação de um cliente'
            ]);

        $this->dispatch('swal', [
        'title' => 'Sucesso!',
        'text' => 'Cliente Editado com sucesso ',
        'icon' => 'success',
        ]);

        $this->reset([
                'nome',
                'email',
                'telefone',
                'ativo',
                'empresa',
                'endereco',
                'documento',
                'tipo',

            ]);

            $this->dispatch('closeModal', ['modalId' => 'edite']);
    }

    public function delete($id)
    {
        Cliente::find($id)->delete();
         $this->dispatch('swal', [
        'title' => 'Sucesso!',
        'text' => 'Cliente Deletado com sucesso ',
        'icon' => 'success',
        ]);
        $this->clientes = Cliente::all();
    }

}
