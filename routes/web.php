<?php

use Illuminate\Support\Facades\Route;

// Rotas de Autenticação
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Home;

//Rotas da Dashboar
use App\Livewire\dashboard\Produtos;
use App\Livewire\dashboard\Clientes;
use App\Livewire\dashboard\Servicos;
use App\Livewire\Perfil;

Route::get('/', Login::class)->name('login');
Route::get('/register', Register::class)->name('Register');
Route::get('/dashboard', Home::class)->name('dashboard')->middleware('auth');

Route::middleware(['auth'])->group(function () {



       //Produtos rota
       Route::get('/produtos', Produtos::class)->name('produtos');

       //Perfil rota
       Route::get('/perfil', Perfil::class)->name('perfil');

       //Clientes Rota
       Route::get('/clientes', Clientes::class)->name('clientes');

       //Servicos Rota
       Route::get('/servicos', Servicos::class)->name('servicos');

});

Route::post('/logout', function () {
    auth()->logout();
    return redirect('/');
})->name('logout');
