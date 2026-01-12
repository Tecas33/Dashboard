<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Perfil extends Component
{
    public $name, $email ,$password;
    public function mount(){
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = $user->password;
    }
    public function render()
    {

        return view('dashboard.Settings.perfil')->layout('components.dashboard');
    }

    public function EditarPerfil()
    {

        dd("olá mundo");
    }
}
