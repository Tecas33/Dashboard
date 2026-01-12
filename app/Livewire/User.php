<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User as Users;

class User extends Component
{
    public function render()
    {
        return view('livewire.user');
    }
}
