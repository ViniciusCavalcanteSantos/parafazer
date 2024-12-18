<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TodoGroupItem extends Model
{
    protected $fillable = [
        'todos_group_id	',
        'title',
        'completed'
    ];
}
