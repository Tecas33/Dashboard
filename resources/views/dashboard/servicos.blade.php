<div class="container pt-4">

    <div class="row">
        <div class="col-md-6">

            <div class="container p-4 shadow bg-white  mt-5 rounded">
                    <h5 class="mb-2">Cadastrar de Serviço</h5>
                <div class="card-body">

                    <form wire:submit.prevent="Salvar">

                        {{-- Nome --}}
                        <div class="mb-3">
                            <label class="form-label">Nome do Serviço</label>
                            <input
                                type="text"
                                class="form-control @error('nome') is-invalid @enderror"
                                wire:model.defer="nome"
                                placeholder="Ex: Manutenção"
                            >
                            @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Descrição --}}
                        <div class="mb-3">
                            <label class="form-label">Descrição</label>
                            <textarea
                                class="form-control @error('descricao') is-invalid @enderror"
                                wire:model.defer="descricao"
                                rows="3"
                                placeholder="Descrição do serviço"
                            ></textarea>
                            @error('descricao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Preço --}}
                        <div class="mb-3">
                            <label class="form-label">Preço</label>
                            <input
                                type="number"
                                step="0.01"
                                class="form-control @error('preco') is-invalid @enderror"
                                wire:model.defer="preco"
                                placeholder="0.00"
                            >
                            @error('preco')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tipo de Cobrança --}}
                        <div class="mb-3">
                            <label class="form-label">Tipo de Cobrança</label>
                            <select
                                class="form-select @error('tipo_cobranca') is-invalid @enderror"
                                wire:model.defer="tipo_cobranca">
                                <option value="">Selecione</option>
                                <option value="hora">Hora</option>
                                <option value="mensal">Mensal</option>
                                <option value="fixo">Fixo</option>
                            </select>
                            @error('tipo_cobranca')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Duração --}}
                        <div class="mb-3">
                            <label class="form-label">Duração</label>
                            <input
                                type="numeric"
                                class="form-control @error('duracao') is-invalid @enderror"
                                wire:model.defer="duracao"
                            >
                            @error('duracao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Ativo --}}
                        <div class="form-check mb-4">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                wire:model.defer="ativo"
                                id="ativo"
                            >
                            <label class="form-check-label" for="ativo">
                                Serviço ativo
                            </label>
                        </div>

                        {{-- Botão --}}
                        <div class="d-grid">
                            <button type="submit" class="btn btn-outline-primary">
                                Salvar Serviço
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>

        <div class="col-md-6">
            <div class="container bg-white shadow rounded p-4 mt-5">
                <h5 class="h5">Serviços Cadastrados</h5>
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>Serviço</th>
                            <th>Preço</th >
                            <th>Cobrança</th>
                            <th>Accções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $servicos as $servico)
                        <tr>
                            <td>{{ $servico->nome}}</td>
                            <td>{{ $servico->preco}}</td>
                            <td>{{ $servico->tipo_cobranca}}</td>
                            <td>
                                <button class="btn btn-primary"  wire:click="edit({{ $servico->id }})"> Editar</button>
                                <button class="btn btn-outline-danger"  wire:click="delete({{ $servico->id }})">Excluir</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center mt-3">
                    {{ $servico->links() }}
                </div>
            </div>
        </div>
    </div>


    <div wire:ignore.self class="modal fade" id="edite" tabindex="-1" aria-labelledby="editeLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content p-3">

              <div class="modal-header border-0">
                    <h5 class="modal-title text-primary" id="editeLabel">🛠 Editar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

      <div class="modal-body">
         <form wire:submit.prevent="Atualizar">

                        {{-- Nome --}}
                        <div class="mb-3">
                            <label class="form-label">Nome do Serviço</label>
                            <input
                                type="text"
                                class="form-control @error('nome') is-invalid @enderror"
                                wire:model.defer="nomeModal"
                                placeholder="Ex: Manutenção"
                            >
                            @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Descrição --}}
                        <div class="mb-3">
                            <label class="form-label">Descrição</label>
                            <textarea
                                class="form-control @error('descricao') is-invalid @enderror"
                                wire:model.defer="descricaoModal"
                                rows="3"
                                placeholder="Descrição do serviço"
                            ></textarea>
                            @error('descricao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Preço --}}
                        <div class="mb-3">
                            <label class="form-label">Preço</label>
                            <input
                                type="number"
                                step="0.01"
                                class="form-control @error('preco') is-invalid @enderror"
                                wire:model.defer="precoModal"
                                placeholder="0.00"
                            >
                            @error('preco')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tipo de Cobrança --}}
                        <div class="mb-3">
                            <label class="form-label">Tipo de Cobrança</label>
                            <select
                                class="form-select @error('tipo_cobranca') is-invalid @enderror"
                                wire:model.defer="tipo_cobrancaModal">
                                <option value="">Selecione</option>
                                <option value="hora">Hora</option>
                                <option value="mensal">Mensal</option>
                                <option value="fixo">Fixo</option>
                            </select>
                            @error('tipo_cobranca')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Duração --}}
                        <div class="mb-3">
                            <label class="form-label">Duração</label>
                            <input
                                type="numeric"
                                class="form-control @error('duracao') is-invalid @enderror"
                                wire:model.defer="duracaoModal"
                            >
                            @error('duracao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Ativo --}}
                        <div class="form-check mb-4">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                wire:model.defer="ativoModal"
                                id="ativo"
                            >
                            <label class="form-check-label" for="ativo">
                                Serviço ativo
                            </label>
                        </div>

                        {{-- Botão --}}

                            <button type="submit" class="btn btn-primary">
                                Editar Serviço
                            </button>

                    </form>

      </div>

    </div>
  </div>
</div>

</div>
