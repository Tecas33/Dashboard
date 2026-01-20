<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email;
    public $password;
    public $error;

     public function render()
    {
        return view('Auth.login')->layout('master.home');
    }

    public function login()
    {
        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials)) {
            session()->regenerate();


            $this->dispatch('swal', [
            'title' => 'Sucesso!',
            'text' => 'Login feito com sucesso',
            'icon' => 'success',
            ]);


            return redirect('/dashboard');
        }else{
        $this->dispatch('swal', [
        'title' => 'Atenção!',
        'text' => 'Email ou senha invalidos',
        'icon' => 'warning',
        ]);
        }




    }


}
