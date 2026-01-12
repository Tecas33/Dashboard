<div class="container mt-5 mb-5 w-50 p-2">
     <h2 class="text-center mb-4">Perfil Usuario</h2>
    <div class="container bg-white rounded  shadow p-4 border-none">
        <div class="row align-items-center justify-content-center">
           <div class="col col-md-3">
              <h5>Imagem</h5>
           </div>
           <div class="col col-md-8">
             <h5 class="fw-bold mb-1">{{ $name }}</h5>
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Email: {{ $email }}</p>
                        {{-- <p class="text-muted mb-1">Telefone Alternativo: {{ $telemovel_alternativo }}</p>
                        <p class="text-muted mb-1">Função: {{ $funcao }}</p> --}}
                    </div>
                </div>
                <button  class="btn btn-primary" wire:click="EditarPerfil">Editar Perfil</button>
           </div>
        </div>
    </div>
</div>
