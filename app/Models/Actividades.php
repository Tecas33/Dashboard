<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actividades extends Model
{
    protected $table = 'actividades';
    protected $fillable = [
    'tipoActividade',
    'responsavel',
    'descricao',
    'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'responsavel');
    }
}
