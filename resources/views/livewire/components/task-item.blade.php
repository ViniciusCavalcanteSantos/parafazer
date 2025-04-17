<?php

use Livewire\Volt\Component;
use App\Models\Task;

new class extends Component {
    public Task $task;
    public string $title;

    public function addSubTask()
    {
        $validated = $this->validate([
            'title' => ['required', 'string', 'min:5', 'max:255'],
        ]);

        $this->task->subTasks()->create([
            'title' => $this->title,
            'task_id' => $this->task->id,
        ]);

        $this->title = "";
    }
}; ?>

<div wire:key="{{ $task->id }}">
    <div class="relative">
        <h2 id="accordion-task-item-heading-{{ $task->id }}">
            <button type="button"
                    class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                    data-accordion-target="#accordion-task-item-body-{{ $task->id }}" aria-expanded="false"
                    aria-controls="accordion-task-item-body-3">
                <span>{{ $task->title }}</span>
            </button>
        </h2>

        <button id="task-item-dropdown-button-{{ $task->id }}" data-dropdown-toggle="task-item-dropdown-{{ $task->id }}"
                class="absolute top-1/2 -translate-y-1/2 right-1 text-white font-medium text-sm px-5 py-2.5 text-center"
                type="button" title="Menu Suspenso">
            <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m1 1 4 4 4-4"/>
            </svg>
        </button>

        <!-- Dropdown menu -->
        <div id="task-item-dropdown-{{ $task->id }}"
             class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                aria-labelledby="task-item-dropdown-button-{{ $task->id }}">
                <li>
                    <button wire:click="removeTask({{ $task->id }})"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-center">
                        Apagar
                    </button>
                </li>
            </ul>
        </div>
    </div>


    <div id="accordion-task-item-body-{{ $task->id }}" class="hidden"
         aria-labelledby="accordion-task-item-heading-{{ $task->id }}">
        <div class="text-center p-5 border border-t-0 border-gray-200 dark:border-gray-700">
            <p class="mb-4 text-gray-500 dark:text-gray-400">Sem Subtarefas 😢</p>

            <button 
                    x-on:click.prevent="$dispatch('open-modal', 'add-subtask-{{ $task->id }}')"
                    type="button"
                    class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">
                Adicionar uma Subtarefa
            </button>

            <div class="relative p-5 mt-2">
                <div class="flex">
                    @forEach($task->subTasks as $subTask)
                        <div class="flex-1">
                            <p class="text-gray-500 dark:text-gray-400">{{ $subTask->title }}</p>
                        </div>
                    @endForEach

                    <p class="absolute right-0 text-gray-500 dark:text-gray-400 text-sm">Criado em: {{ $task->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>

    <x-modal name="add-subtask-{{ $task->id }}" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="addSubTask" class="p-6">
            <div>
                <x-input-label for="title" :value="__('Titulo')"/>
                <x-text-input wire:model="title" id="title" class="block mt-1 w-full"
                              type="text"
                              name="title"
                              required autofocus/>
                <x-input-error :messages="$errors->get('title')" class="mt-2"/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-3" type="submit">
                    {{ __('Criar Tarefa') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</div>
