<x-app-layout>
    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route("register") }}">
                <button type="button" 
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'add-todo')"
                    class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800"
                >
                    Adicionar Tarefa
                </button>
            </a>
        </div>
    </div>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @forEach($todoGroups as $todoGroup)
                        <x-todo.todo-group-list :$todoGroup />
                    @endForEach
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
                <x-input-error :messages="$errors->get('form.title')" class="mt-2" />
            </div>
    
            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-3" type="submit">
                    {{ __('Criar Tarefa') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</x-app-layout>