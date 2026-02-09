<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WelcomeController;

use App\Livewire\Settings\UserManagement;

use App\Livewire\Posts\AllPosts;
use App\Livewire\Posts\ShowPosts;

use App\Livewire\Comments\ShowComments;


/*
Route::get('/', function () {
    return view('welcome');
})->name('home'); */

Route::get('/', [WelcomeController::class, 'show'])->name('home'); 

/*
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard'); */

Route::middleware(['auth'])->group(function () {    
    Route::get('dashboard', AllPosts::class)->name('dashboard');
});


Route::middleware(['auth'])->group(function () {    
    Route::get('posts', ShowPosts::class)->name('showposts');
    Route::get('comments', ShowComments::class)->name('showcomments');
}); 

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    Route::get('settings/users', UserManagement::class)->name('settings.users');
});

require __DIR__.'/auth.php';
