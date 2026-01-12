<div class="container py-5">
    <div class="row g-3 pt-5 d-flex col-12 justify-content-center align-items-center">
        <div class="col-12 col-md-4">
            <div class="card shadow " style="max-width:300px;border-left:5px solid #0d6efd">
                <div class="card-body  border-primary d-flex flex-column justify-content-center align-items-center">
                    <p class="display-7 ">Produtos</p>
                    <span class="">{{ $CountProdutos }}</span>
                </div>
            </div>
        </div>



        <div class="col-12 col-md-4">
            <div class="card shadow" style="max-width:300px;border-left:5px solid #ffc107">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <p class="display-7">Clientes</p>
                    <span>{{ $CountClientes }}</span>
                </div>
            </div>
        </div>



        <div class="col-12 col-md-4">
            <div class="card shadow" style="max-width:300px;border-left:5px solid #20c997">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <p class="display-7">Serviços</p>
                    <span>{{ $CountServicos }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-4 mt-5">
                  <div class="card shadow">
                    <div class="card-header bg-primary">
                        <strong class="card-title float-left  text-white">Atividades Recente</strong>
                    </div>
                    <div class="card-body">
                      <div class="list-group list-group-flush my-n3">
                        @foreach($CountActividades as $atividade)
                          <div class="list-group-item">
                            <div class="row">
                              <div class="col-auto">
                                <div class="avatar avatar-sm mt-2">
                                  <img src="{{ asset('images/user.png') }}" alt="..." class="avatar-img rounded-circle">
                                </div>
                              </div>
                              <div class="col">
                                <small><strong>{{ $atividade->user->name}}</strong></small>
                                <div class="my-0 text-muted small">{{ $atividade->descricao }}</div>
                              </div>
                            </div>
                          </div>
                        @endforeach

                      </div> <!-- / .list-group -->
                    </div> <!-- / .card-body -->
                  </div> <!-- / .card -->


                </div>



    </div>


</div>


