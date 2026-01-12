<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    protected $table = 'produtos';

    protected $fillable = [
        'nome',
        'cliente_id',
        'sku',
        'descricao',
        'categoria',
        'preco',
        'preco_promocional',
        'stock',
        'activo',
        'imagem',
        'user_id'
    ];
}
