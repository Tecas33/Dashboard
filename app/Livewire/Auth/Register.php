<?php

namespace App\Livewire\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class Register extends Component
{

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $error;


    public function render()
    {
        return view('Auth.register')->layout('master.home');
    }

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'password' => 'required|min:2'
    ];

    public function Register()
    {

        $this->validate();

        if(empty($this->name) || empty($this->email) || empty($this->password)){
           $this->error = 'Email ou senha inválidos';
           return;
        }


         if($this->password  !== $this->password_confirmation){
                $this->dispatch('swal', [
                'title' => 'Atenção!',
                'text' => 'As senhas não coincedem ',
                'icon' => 'warning',
                ]);
           return;
        }


        $user = User::create([
        'name' => $this->name,
        'email' => $this->email,
        'password' => Hash::make($this->password)
        ]);

        $this->dispatch('swal', [
        'title' => 'Sucesso!',
        'text' => 'Cadastro feito com sucesso',
        'icon' => 'success',
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }
}
