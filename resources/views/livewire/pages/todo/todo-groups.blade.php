<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Models\TodoGroup;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

new #[Layout('layouts.app')] class extends Component
{
    public string $title;
    public int $users_id;
    public Collection $todoGroups;

    public function mount() {
        $users_id = Auth::user()->id;
        $this->todoGroups = TodoGroup::where("users_id", $users_id)->get();
    }

    public function addTodo() {
        $users_id = Auth::user()->id;
        $this->users_id = $users_id;
        $validated = $this->validate([
            'title' => ['required', 'string', 'min:5', 'max:255'],
            'users_id' => ['required', 'integer', 'numeric', 'max:255', 'exists:'.User::class.',id'],
        ]);

        TodoGroup::create($validated);
        $this->todoGroups = TodoGroup::where("users_id", $users_id)->get();
        $this->dispatch('close-modal', 'add-todo');
    }
}; ?>

<div>
    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <button type="button"
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'add-todo')"
                class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800"
            >
                Adicionar Tarefa
            </button>
        </div>
    </div>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div id="accordion-todo-group" data-accordion="open">
                        @forEach($todoGroups as $todoGroup)
                            <x-todo.todo-group-list :$todoGroup />
                        @endForEach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal name="add-todo" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="addTodo" class="p-6">
            <div>
                <x-input-label for="title" :value="__('Titulo')" />
                <x-text-input wire:model="title" id="title" class="block mt-1 w-full"
                                type="text"
                                name="title"
                                required autofocus />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-3" type="submit">
                    {{ __('Criar Tarefa') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</div>
