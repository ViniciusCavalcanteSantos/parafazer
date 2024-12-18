<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Volt::route('/', 'pages.auth.login')
    ->name('login');

    Volt::route('registrar', 'pages.auth.register')
        ->name('register');

    Volt::route('esqueceu-senha', 'pages.auth.forgot-password')
        ->name('password.request');

    Volt::route('recuperar-senha/{token}', 'pages.auth.reset-password')
        ->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Volt::route('verificar-email', 'pages.auth.verify-email')
        ->name('verification.notice');

    Route::get('verificar-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Volt::route('confirmar-senha', 'pages.auth.confirm-password')
        ->name('password.confirm');
});
