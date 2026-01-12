<div class="container py-5">

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <!-- Formulário -->
    <div class="container mt-5 bg-white p-4 shadow rounded">
        <h4 class="mb-4 fw-bold">Cadastro de Clientes</h4>
            <form wire:submit.prevent="Salvar">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" id="nome" class="form-control" wire:model.defer="nome">
                        @error('nome') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" wire:model.defer="email">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" id="telefone" class="form-control" wire:model.defer="telefone">
                    </div>

                    <div class="col-md-6">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select id="tipo" class="form-select" wire:model.defer="tipo">
                            <option value="PF">PF</option>
                            <option value="PJ">PJ</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="documento" class="form-label">Documento</label>
                        <input type="text" id="documento" class="form-control" wire:model.defer="documento">
                    </div>

                    <div class="col-md-6">
                        <label for="empresa" class="form-label">Empresa</label>
                        <input type="text" id="empresa" class="form-control" wire:model.defer="empresa">
                    </div>

                    <div class="col-12">
                        <label for="endereco" class="form-label">Endereço</label>
                        <textarea id="endereco" class="form-control" wire:model.defer="endereco"></textarea>
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <input type="checkbox" id="ativo" class="form-check-input" wire:model.defer="ativo">
                            <label for="ativo" class="form-check-label">Ativo</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            {{ $clienteId ? 'Atualizar' : 'Salvar' }}
                        </button>
                        <button type="button" class="btn btn-secondary ms-2" wire:click="resetForm">Limpar</button>
                    </div>
                </div>
            </form>
    </div>

    <!-- Lista de clientes -->
    <div class="container mt-5 bg-white p-4 shadow rounded">
            <h5>Clientes cadastrados</h5>
            <table class="table table-striped mt-3 align-middle">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Tipo</th>
                        <th>Ativo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->nome }}</td>
                            <td>{{ $cliente->email }}</td>
                            <td>{{ $cliente->telefone }}</td>
                            <td>{{ $cliente->tipo }}</td>
                            <td>{{ $cliente->ativo ? 'Sim' : 'Não' }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" wire:click="edit({{ $cliente->id }}) " data-bs-toggle="modal" data-bs-target="EditModal">Editar</button>
                                <button class="btn btn-sm btn-danger" wire:click="delete({{ $cliente->id }})">Excluir</button>
                            </td>
                        </tr>
                    @endforeach
                    @if($clientes->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center">Nenhum cliente cadastrado</td>
                        </tr>
                    @endif
                </tbody>
            </table>
    </div>



    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="edite" tabindex="-1" aria-labelledby="editeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-3">
        <div class="modal-header border-0">
                <h5 class="modal-title text-primary" id="editeLabel">🛠 Editar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent="Atualizar">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" id="nome" class="form-control" wire:model.defer="nomeModal">
                        @error('nome') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" wire:model.defer="emailModal">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" id="telefone" class="form-control" wire:model.defer="telefoneModal">
                    </div>

                    <div class="col-md-6">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select id="tipo" class="form-select" wire:model.defer="tipoModal">
                            <option value="PF">PF</option>
                            <option value="PJ">PJ</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="documento" class="form-label">Documento</label>
                        <input type="text" id="documento" class="form-control" wire:model.defer="documentoModal">
                    </div>

                    <div class="col-md-6">
                        <label for="empresa" class="form-label">Empresa</label>
                        <input type="text" id="empresa" class="form-control" wire:model.defer="empresaModal">
                    </div>

                    <div class="col-12">
                        <label for="endereco" class="form-label">Endereço</label>
                        <textarea id="endereco" class="form-control" wire:model.defer="enderecoModal"></textarea>
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <input type="checkbox" id="ativo" class="form-check-input" wire:model.defer="ativoModal">
                            <label for="ativo" class="form-check-label">Ativo</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                           Atualizar
                        </button>
                    </div>
                </div>
            </form>
        </div>
        {{-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
        </div>
    </div>
    </div>
</div>
