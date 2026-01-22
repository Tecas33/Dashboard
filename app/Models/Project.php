<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['user_id', 'name', 'description', 'status'];

    // Relacionamento com o Dono (Usuário)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacionamento com as Tarefas
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
