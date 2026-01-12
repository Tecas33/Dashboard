<div class="container py-5">

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="card p-4 mb-5">
  <h5 class="fw-bold mb-4">Novo Cliente</h5>

  <form wire:submit.prevent="Salvar">
    <div class="row g-3">

      <div class="col-md-6">
        <label class="form-label small text-white">Nome</label>
        <input class="form-control" wire:model.defer="nome">
      </div>

      <div class="col-md-6">
        <label class="form-label small text-white">Email</label>
        <input type="email" class="form-control" wire:model.defer="email">
      </div>

      <div class="col-md-4">
        <label class="form-label small text-white">Telefone</label>
        <input class="form-control" wire:model.defer="telefone">
      </div>

      <div class="col-md-4">
        <label class="form-label small text-white">Tipo</label>
        <select class="form-select" wire:model.defer="tipo">
          <option value="PF">Pessoa Física</option>
          <option value="PJ">Pessoa Jurídica</option>
        </select>
      </div>

      <div class="col-md-4">
        <label class="form-label small text-white">Documento</label>
        <input class="form-control" wire:model.defer="documento">
      </div>

      <div class="col-md-6">
        <label class="form-label small text-white">Empresa</label>
        <input class="form-control" wire:model.defer="empresa">
      </div>

      <div class="col-md-6">
        <label class="form-label small text-white">Endereço</label>
        <textarea class="form-control" wire:model.defer="endereco"></textarea>
      </div>

      <div class="col-12 d-flex justify-content-between align-items-center mt-4">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" wire:model.defer="ativo">
          <label class="form-check-label">Cliente ativo</label>
        </div>

        <div>
          <button class="btn btn-primary px-4">
            {{ $clienteId ? 'Atualizar' : 'Salvar' }}
          </button>
          <button type="button" class="btn btn-outline-secondary ms-2" wire:click="resetForm">Limpar</button>
        </div>
      </div>

    </div>
  </form>
</div>


   <div class="card p-4">
  <h5 class="fw-bold mb-4">Clientes</h5>

  <table class="table align-middle">
    <thead class="text-muted small">
      <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>Tipo</th>
        <th>Status</th>
        <th class="text-end">Ações</th>
      </tr>
    </thead>

    <tbody>
      @foreach ($clientes as $c)
      <tr>
        <td>{{ $c->nome }}</td>
        <td class="text-muted">{{ $c->email }}</td>
        <td>{{ $c->telefone }}</td>
        <td>{{ $c->tipo }}</td>
        <td>
          <span class="badge {{ $c->ativo ? 'bg-success' : 'bg-secondary' }}">
            {{ $c->ativo ? 'Ativo' : 'Inativo' }}
          </span>
        </td>
        <td class="text-end">
          <button class="btn btn-sm btn-outline-primary" wire:click="edit({{ $c->id }})">Editar</button>
          <button class="btn btn-sm btn-outline-danger" wire:click="delete({{ $c->id }})">Excluir</button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>




    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="edite" tabindex="-1" aria-labelledby="editeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content card">
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
