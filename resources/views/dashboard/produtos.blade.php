 <div class="container py-5">

   <div class="row justify-content-center">
    <div class="col-lg-12">
        
     <div class="container mt-5 p-4 shadow rounded bg-white">
        <h3 class="text-center fw-bold">Cadastrar produto</h3>
        
        <form wire:submit.prevent="save"   enctype="multipart/form-data" class="p-4">

            <div class="row">
                <div class="col-md-6 mb-3">
                <label for="nome" class="form-label">Nome do Produto</label>
                <input type="text" class="form-control" id="nome" name="nome" wire:model="nome" placeholder="Digite o nome do produto" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="sku" class="form-label">SKU</label>
                <input type="text" class="form-control" id="sku" name="sku" placeholder="Código do produto" wire:model="sku" required>
            </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="categoria" class="form-label">Categoria</label>
                    <select class="form-select" id="categoria" name="categoria" wire:model="categoria">
                        <option value="" selected>Selecione uma categoria</option>
                        <option value="eletronicos">Eletrônicos</option>
                        <option value="moveis">Móveis</option>
                        <option value="roupas">Roupas</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">     
                <label for="cliente_id" class="form-label">Cliente</label>
                <select class="form-select" id="cliente_id" name="cliente_id" wire:model="cliente_id">
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
                    <input type="number" class="form-control" id="preco" name="preco" placeholder="R$ 0,00" step="0.01" required wire:model="preco">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="preco_promocional" class="form-label">Preço Promocional</label>
                    <input type="number" class="form-control" id="preco_promocional" name="preco_promocional" placeholder="R$ 0,00" step="0.01" wire:model="preco_promocional">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="stock" class="form-label">Quantidade em Estoque</label>
                    <input type="number" class="form-control" id="stock" name="stock" placeholder="0" min="0" required wire:model="stock">
                </div>
            </div>

           

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="4" placeholder="Detalhes do produto" wire:model="descricao"></textarea>
            </div>

            <div class="mb-3">
                <label for="imagem" class="form-label">Imagem do Produto</label>
                <input class="form-control" type="file" id="imagem" name="imagem" accept="image/*" wire:model="imagem">
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="ativo" name="ativo" checked wire:model="activo">
                <label class="form-check-label" for="ativo">Produto Ativo</label>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Produto</button>
        </form>
    </div>
    </div>
   </div>


    <div class="container mt-5 bg-white shadow rounded p-4">
            <h5>Produtos Cadastrados</h5>
            <table class="table table-striped mt-5">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Preço</th>
                        <th>Preço-Promocional</th>
                        <th>Stock</th>
                        <th>Accções</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $produtos as $produto)
                    <tr>
                        <td>{{ $produto->nome }}</td>
                        <td>{{ $produto->categoria }}</td>
                        <td>{{ $produto->preco }}</td>
                        <td>{{ $produto->preco_promocional }}</td>
                        <td>{{ $produto->stock }}</td>
                        <td>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#produtoModal">Editar</button>
                            <button class="btn btn-outline-danger" wire:click="delete({{ $produto->id }})">Excluir</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div>


   


<div class="modal fade" id="produtoModal" tabindex="-1" aria-labelledby="produtoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="produtoModalLabel">Cadastrar Produto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      
      <div class="modal-body">
        <!-- SEU FORMULÁRIO AQUI -->
        <form wire:submit.prevent="save"   enctype="multipart/form-data" class="p-4">

            <div class="row">
                <div class="col-md-6 mb-3">
                <label for="nome" class="form-label">Nome do Produto</label>
                <input type="text" class="form-control" id="nome" name="nome" wire:model="nome" placeholder="Digite o nome do produto" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="sku" class="form-label">SKU</label>
                <input type="text" class="form-control" id="sku" name="sku" placeholder="Código do produto" wire:model="sku" required>
            </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="categoria" class="form-label">Categoria</label>
                    <select class="form-select" id="categoria" name="categoria" wire:model="categoria">
                        <option value="" selected>Selecione uma categoria</option>
                        <option value="eletronicos">Eletrônicos</option>
                        <option value="moveis">Móveis</option>
                        <option value="roupas">Roupas</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">     
                <label for="cliente_id" class="form-label">Cliente</label>
                <select class="form-select" id="cliente_id" name="cliente_id" wire:model="cliente_id">
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
                    <input type="number" class="form-control" id="preco" name="preco" placeholder="R$ 0,00" step="0.01" required wire:model="preco">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="preco_promocional" class="form-label">Preço Promocional</label>
                    <input type="number" class="form-control" id="preco_promocional" name="preco_promocional" placeholder="R$ 0,00" step="0.01" wire:model="preco_promocional">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="stock" class="form-label">Quantidade em Estoque</label>
                    <input type="number" class="form-control" id="stock" name="stock" placeholder="0" min="0" required wire:model="stock">
                </div>
            </div>

           

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="4" placeholder="Detalhes do produto" wire:model="descricao"></textarea>
            </div>

            <div class="mb-3">
                <label for="imagem" class="form-label">Imagem do Produto</label>
                <input class="form-control" type="file" id="imagem" name="imagem" accept="image/*" wire:model="imagem">
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="ativo" name="ativo" checked wire:model="activo">
                <label class="form-check-label" for="ativo">Produto Ativo</label>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Produto</button>
        </form>
      </div>
      
    </div>
  </div>
</div>


</div>
   
