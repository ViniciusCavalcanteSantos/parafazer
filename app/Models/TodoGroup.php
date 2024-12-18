<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TodoGroup extends Model
{
    protected $fillable = [
        'users_id',
        'title'
    ];

    public function todoGroupItem(): HasMany
    {
        return $this->hasMany(TodoGroupItem::class);
    }
}
