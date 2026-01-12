<div class="container vh-100 d-flex justify-content-center align-items-center ">

    <div class="row w-100 shadow rounded">

        <!-- IMAGEM -->
        <div class="col-md-6 col-12  d-flex justify-content-center bg-light rounded-3 align-items-center">
            <img 
                src="{{ asset('images/Computer login-rafiki.png') }}" 
                alt="Ilustração"
                class="img-fluid"
                style="max-height: 600px;"
            >
        </div>

        <!-- LOGIN -->
        <div class="col-md-6 col-12 d-flex justify-content-center  align-items-center">
            <div class=" p-4    w-100" style="max-width: 470px;">

                @if($error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endif

                <h2 class="text-center mb-4 text-primary fw-bold">Login</h2>

                <form wire:submit.prevent="login">

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input 
                            type="email" 
                            wire:model="email" 
                            class="form-control"
                            placeholder="Email"
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Senha</label>
                        <input 
                            type="password" 
                            wire:model="password" 
                            class="form-control"
                            placeholder="Senha"
                        >
                    </div>

                    <button class="btn btn-primary w-100" type="submit">
                        Login
                    </button>
                </form>

                <div class="text-center mt-3">
                    <a href="{{ route('Register') }}">
                        Não tem conta? Cadastre-se
                    </a>
                </div>

            </div>
        </div>

    </div>

</div>
