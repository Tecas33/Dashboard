 <div class="container py-5">

   <div class="card p-4 mb-5">
  <h5 class="fw-bold mb-4">Novo Produto</h5>

  <form wire:submit.prevent="save" enctype="multipart/form-data">

    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label small text-white">Nome</label>
        <input type="text" class="form-control" wire:model="nome">
      </div>

      <div class="col-md-6">
        <label class="form-label small text-white">SKU</label>
        <input type="text" class="form-control" wire:model="sku">
      </div>

      <div class="col-md-6">
        <label class="form-label small text-white">Categoria</label>
        <select class="form-select" wire:model="categoria">
          <option value="">Selecione uma categoria</option>
          <option value="eletronicos">Eletrônicos</option>
          <option value="moveis">Móveis</option>
          <option value="roupas">Roupas</option>
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label small text-white">Cliente</label>
        <select class="form-select" wire:model="cliente_id">
            <option value="">Selecione um cliente</option>
          @foreach($clientes as $c)
            <option value="{{ $c->id }}">{{ $c->nome }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-4">
        <label class="form-label small text-white">Preço</label>
        <input type="number" class="form-control" wire:model="preco">
      </div>

      <div class="col-md-4">
        <label class="form-label small text-white">Promoção</label>
        <input type="number" class="form-control" wire:model="preco_promocional">
      </div>

      <div class="col-md-4">
        <label class="form-label small text-white">Stock</label>
        <input type="number" class="form-control" wire:model="stock">
      </div>

      <div class="col-12">
        <label class="form-label small text-white">Descrição</label>
        <textarea class="form-control" rows="3" wire:model="descricao"></textarea>
      </div>

      <div class="col-md-6">
        <input type="file" class="form-control" wire:model="imagem">
      </div>

      <div class="col-md-6 d-flex align-items-center">
        <div class="form-check mt-4">
          <input class="form-check-input" type="checkbox" wire:model="activo">
          <label class="form-check-label">Produto ativo</label>
        </div>
      </div>

      <div class="col-12 text-end mt-4">
        <button class="btn btn-primary px-4">Salvar</button>
      </div>
    </div>

  </form>
</div>



    <div class="card p-4">
  <h5 class="fw-bold mb-4">Produtos</h5>

  <table class="table align-middle">
    <thead>
      <tr class="text-muted small">
        <th>Nome</th>
        <th>Categoria</th>
        <th>Preço</th>
        <th>Promoção</th>
        <th>Stock</th>
        <th class="text-end">Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach($produtos as $p)
      <tr>
        <td>{{ $p->nome }}</td>
        <td class="text-muted">{{ $p->categoria }}</td>
        <td>R$ {{ $p->preco }}</td>
        <td class="text-success">{{ $p->preco_promocional }}</td>
        <td>{{ $p->stock }}</td>
        <td class="text-end">
          <button class="btn btn-sm btn-outline-primary" wire:click="abrirmodal({{ $p->id }})">Editar</button>
          <button class="btn btn-sm btn-outline-danger" wire:click="delete({{ $p->id }})">Excluir</button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>






  <div wire:ignore.self class="modal fade" id="edite" tabindex="-1" aria-labelledby="editeLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content card">

              <div class="modal-header border-0">
                    <h5 class="modal-title text-primary" id="editeLabel">🛠 Editar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

      <div class="modal-body">
         <form wire:submit.prevent="atualizar"   enctype="multipart/form-data" class="p-4">

            <div class="row">
                <div class="col-md-6 mb-3">
                <label for="nome" class="form-label">Nome do Produto</label>
                <input type="text" class="form-control" id="nome" name="nome" wire:model="nomeModal" placeholder="Digite o nome do produto" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="sku" class="form-label">SKU</label>
                <input type="text" class="form-control" id="sku" name="skuModal" placeholder="Código do produto" wire:model="skuModal" required>
            </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="categoria" class="form-label">Categoria</label>
                    <select class="form-select" id="categoria" name="categoria" wire:model="categoriaModal">
                        <option value="" selected>Selecione uma categoria</option>
                        <option value="eletronicos">Eletrônicos</option>
                        <option value="moveis">Móveis</option>
                        <option value="roupas">Roupas</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                <label for="cliente_id" class="form-label">Cliente</label>
                <select class="form-select" id="cliente_id" name="cliente_id" wire:model="cliente_idModal">
                    <option value=""> Selecione um cliente </option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">
                            {{ $cliente->nome }}
                        </option>
                    @endforeach
                </select>
                </div>
            </div>




            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="preco" class="form-label">Preço</label>
                    <input type="number" class="form-control" id="preco" name="preco" placeholder="R$ 0,00" step="0.01" required wire:model="precoModal">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="preco_promocional" class="form-label">Preço Promocional</label>
                    <input type="number" class="form-control" id="preco_promocional" name="preco_promocional" placeholder="R$ 0,00" step="0.01" wire:model="preco_promocionalModal">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="stock" class="form-label">Quantidade em Estoque</label>
                    <input type="number" class="form-control" id="stock" name="stock" placeholder="0" min="0" required wire:model="stockModal">
                </div>
            </div>



            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="4" placeholder="Detalhes do produto" wire:model="descricaoModal"></textarea>
            </div>

            <div class="mb-3">
                <label for="imagem" class="form-label">Imagem do Produto</label>
                <input class="form-control" type="file" id="imagem" name="imagem" accept="image/*" wire:model="imagemModal">
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="ativo" name="ativo" wire:model="activoModal">
                <label class="form-check-label" for="ativo">Produto Ativo</label>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Produto</button>
        </form>

      </div>

    </div>
  </div>
</div>

</div>

