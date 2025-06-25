<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Volt::route('/estimating', 'estimating')->name('estimating');
    Volt::route('/project/{projectId}', 'project-view')->name('project-view');
    Volt::route('/project/{projectId}/proposal/{proposalId}', 'proposal-view')->name('proposal-view');

    Volt::route('/selections', 'selections')->name('selections');

    Volt::route('/accounts', 'accounts')->name('accounts');

    Volt::route('/categories', 'categories')->name('categories');
});

require __DIR__.'/auth.php';
