<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'tipo',
        'documento',
        'empresa',
        'endereco',
        'ativo',
        'user_id'
    ];
}
