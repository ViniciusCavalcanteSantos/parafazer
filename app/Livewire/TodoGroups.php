<?php

namespace App\Livewire;

use App\Models\TodoGroup;
use Livewire\Component;

class TodoGroups extends Component
{
    public function render()
    {
        $todoGroups = TodoGroup::get();
        return view('livewire.pages.todo.todo-groups', [
            "todoGroups" => $todoGroups
        ]);
    }
}
