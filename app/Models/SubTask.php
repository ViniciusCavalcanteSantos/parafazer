<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{
    protected $fillable = [
        'tasks_id	',
        'title',
        'completed'
    ];
}
