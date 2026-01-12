<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicos extends Model
{
    use HasFactory;

    protected $table = 'servicos';

    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'duracao',
        'tipo_cobranca',
        'ativo',
        'user_id'
    ];
}
