<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware(["auth", "verified"])->group(function() {
    Volt::route("tarefas", "pages.tasks.tasks")
        ->name("tasks");

    Route::view('perfil', 'profile')
        ->name('profile');
});

require __DIR__.'/auth.php';
