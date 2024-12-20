<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TodoGroupItem extends Model
{
    protected $table = "todo_group_item";
    protected $fillable = [
        'todos_group_id	',
        'title',
        'completed'
    ];
}
