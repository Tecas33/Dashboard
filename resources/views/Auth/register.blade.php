<div class="container vh-100 d-flex justify-content-center align-items-center ">
  

 <div class="row w-100 shadow rounded bg-white">
   <div class="col-md-6 col-12  d-flex justify-content-center bg-light rounded-3 align-items-center">
            <img 
                src="{{ asset('images/Setup Analytics-pana.png') }}" 
                alt="Ilustração"
                class="img-fluid"
                style="max-height: 600px;"
            >
    </div>


<div class="col-md-6 p-4 d-flex justify-content-center align-items-center" >
      
    <div class="p-4 w-100" style="width:100%; max-width:500px">
       <!-- Erros -->
    @if($error)
      <div class="alert alert-danger">{{ $error }}</div>
     @endif
    <h2 class="text-center text-primary fw-bold">Registrar-se</h2>

    <form wire:submit.prevent="Register">
       <div class="">
            <label for="" class="form-label">Nome</label>
            <input type="text" wire:model="name" placeholder="Nome" class="form-control">
        </div>
         @error('name')
          <span style="color:red">{{ $message }}</span>
        @enderror

             
        
       <div class="mb-3">
            <label for="" class="form-label">Email</label>
            <input type="email" wire:model="email" placeholder="Email" class="form-control">
        </div>
         @error('email')
          <span style="color:red">{{ $message }}</span>
        @enderror


        <div class="mb-3">
            <label for="" class="form-label">Password</label>
            <input type="password" wire:model="password" placeholder="Senha" class="form-control">
        </div>
         @error('password')
          <span style="color:red">{{ $message }}</span>
        @enderror

         <div class="mb-3">
            <label for="" class="form-label">Password</label>
            <input type="password" wire:model="password_confirmation" placeholder="Confirmar senha" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
    </form>

   <div class="text-center mt-3">
     <a href="{{ route('login') }}" >fazer login</a>
   </div>
</div>
    </div>
 </div>

</div>
