<?php

use App\Models\Task;
use App\Models\User;
use Livewire\Volt\Volt;

test('new tasks can be created and deleted', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $component = Volt::test('pages.tasks.tasks')
        ->set('title', 'Tarefa Teste');
    $component->call('addTask');

    $component
        ->assertHasNoErrors()
        ->assertSeeText("Tarefa Teste");

    $task = Task::where('title', 'Tarefa Teste')->latest()->first();
    $component->call('removeTask', $task->id);
    $component->assertDontSeeText("Tarefa Teste");
});
