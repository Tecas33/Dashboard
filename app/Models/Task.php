<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['project_id', 'title', 'is_completed', 'due_date', 'user_id', 'description'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
