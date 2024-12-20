<?php

use App\Livewire\TodoGroups;
use Illuminate\Support\Facades\Route;

Route::middleware(["auth", "verified"])->group(function() {
    Route::get("tarefas", [TodoGroups::class, "render"])
        ->name("dashboard");
});

Route::view('perfil', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
