<div class="container py-5">

    {{-- Cards de contagem --}}
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card shadow-sm p-4 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Produtos</small>
                        <h2 class="fw-bold mt-2">{{ $CountProdutos }}</h2>
                    </div>
                    <div class="icon bg-primary bg-opacity-25 text-primary rounded-circle p-3 fs-4">
                        📦
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-4 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Clientes</small>
                        <h2 class="fw-bold mt-2">{{ $CountClientes }}</h2>
                    </div>
                    <div class="icon bg-success bg-opacity-25 text-success rounded-circle p-3 fs-4">
                        👥
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-4 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Serviços</small>
                        <h2 class="fw-bold mt-2">{{ $CountServicos }}</h2>
                    </div>
                    <div class="icon bg-warning bg-opacity-25 text-warning rounded-circle p-3 fs-4">
                        🛠
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Atividades Recentes --}}
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white border-0">
            <strong>Atividades Recentes</strong>
        </div>
        <div class="list-group list-group-flush">

            @foreach($CountActividades as $a)
            <div class="list-group-item bg-transparent border-bottom d-flex justify-content-between align-items-center">
                <div>
                    <strong class="text-white">{{ $a->user->name ?? 'Sem usuário' }}</strong>
                    <div class="text-primary small">{{ $a->descricao }}</div>
                    <small class="text-muted">{{ $a->created_at->diffForHumans() }}</small>
                </div>
                <div>
                    <button class="btn btn-sm btn-outline-primary" wire:click="openModal({{ $a->id }})">
                        Ver detalhes
                    </button>
                </div>
            </div>
            @endforeach

        </div>
    </div>

    {{-- Modal de detalhes --}}
    <div wire:ignore.self class="modal fade" id="edite" tabindex="-1" aria-labelledby="editeLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 bg-primary text-white">
                    <h5 class="modal-title" id="editeLabel">Detalhes da Atividade</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tipo de Atividade</label>
                        <input type="text" class="form-control" readonly value="{{ $tipoActividade }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Responsável</label>
                        <input type="text" class="form-control" readonly value="{{ $responsavel }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Descrição</label>
                        <textarea class="form-control" rows="3" readonly>{{ $descricao }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Usuário</label>
                        <input type="text" class="form-control" readonly value="{{ $user->name }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

</div>
