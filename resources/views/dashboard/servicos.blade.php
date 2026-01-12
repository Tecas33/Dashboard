<div class="container py-5">

    {{-- Mensagem de sucesso --}}
    @if (session()->has('message'))
        <div class="alert alert-success shadow-sm">{{ session('message') }}</div>
    @endif

    <div class="row g-4">

        {{-- Formulário de cadastro --}}
        <div class="col-lg-6">
            <div class="card shadow-sm p-4 h-100">
                <h5 class="fw-bold mb-4 text-primary">Novo Serviço</h5>
                <form wire:submit.prevent="Salvar">
                    <div class="row g-3">

                        <div class="col-12 col-md-12">
                            <label class="form-label small text-white">Nome do Serviço</label>
                            <input class="form-control" wire:model.defer="nome" placeholder="Ex: Manutenção">
                            @error('nome') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label small text-white">Descrição</label>
                            <textarea class="form-control" wire:model.defer="descricao" rows="3" placeholder="Descrição do serviço"></textarea>
                            @error('descricao') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label small text-white">Preço</label>
                            <input type="number" step="0.01" class="form-control" wire:model.defer="preco" placeholder="0.00">
                            @error('preco') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label small text-white">Tipo de Cobrança</label>
                            <select class="form-select" wire:model.defer="tipo_cobranca">
                                <option value="">Selecione</option>
                                <option value="hora">Hora</option>
                                <option value="mensal">Mensal</option>
                                <option value="fixo">Fixo</option>
                            </select>
                            @error('tipo_cobranca') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label small text-white">Duração</label>
                            <input type="numeric" class="form-control" wire:model.defer="duracao">
                            @error('duracao') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-12 col-md-6 d-flex align-items-center">
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" wire:model.defer="ativo" id="ativo">
                                <label class="form-check-label small">Serviço ativo</label>
                            </div>
                        </div>

                        <div class="col-12 d-flex justify-content-end">
                            <button class="btn btn-primary px-4">
                                {{ $servicoId ? 'Atualizar' : 'Salvar' }}
                            </button>
                            <button type="button" class="btn btn-outline-secondary ms-2" wire:click="resetForm">Limpar</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        {{-- Lista de serviços --}}
        <div class="col-lg-6">
            <div class="card shadow-sm p-4 h-100">
                <h5 class="fw-bold mb-4 text-primary">Serviços Cadastrados</h5>

                <div class="table-responsive">
                    <table class="table align-middle table-hover">
                        <thead class="text-muted small">
                            <tr>
                                <th>Serviço</th>
                                <th>Preço</th>
                                <th>Cobrança</th>
                                <th class="text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($servicos as $servico)
                            <tr>
                                <td>{{ $servico->nome }}</td>
                                <td>{{ $servico->preco }}</td>
                                <td>{{ $servico->tipo_cobranca }}</td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-primary" wire:click="edit({{ $servico->id }})">Editar</button>
                                    <button class="btn btn-sm btn-outline-danger" wire:click="delete({{ $servico->id }})">Excluir</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {{ $servicos->links() }}
                </div>
            </div>
        </div>

    </div>

    {{-- Modal de edição --}}
    <div wire:ignore.self class="modal fade" id="edite" tabindex="-1" aria-labelledby="editeLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content card">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-primary" id="editeLabel">🛠 Editar Serviço</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="Atualizar" class="row g-3">
                        <div class=" col-12 col-md-6">
                            <label class="form-label small text-white">Nome do Serviço</label>
                            <input type="text" class="form-control" wire:model.defer="nomeModal">
                            @error('nomeModal') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label small text-white">Preço</label>
                            <input type="number" step="0.01" class="form-control" wire:model.defer="precoModal">
                            @error('precoModal') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label small text-white">Descrição</label>
                            <textarea class="form-control" wire:model.defer="descricaoModal" rows="3"></textarea>
                            @error('descricaoModal') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label small text-white">Tipo de Cobrança</label>
                            <select class="form-select" wire:model.defer="tipo_cobrancaModal">
                                <option value="">Selecione</option>
                                <option value="hora">Hora</option>
                                <option value="mensal">Mensal</option>
                                <option value="fixo">Fixo</option>
                            </select>
                            @error('tipo_cobrancaModal') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-12 col-md-6 d-flex align-items-center">
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" wire:model.defer="ativoModal" id="ativoModal">
                                <label class="form-check-label small">Ativo</label>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button class="btn btn-primary">Atualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
