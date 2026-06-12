<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {

    Route::resource('users', UserController::class);
    Route::post('/users/{user}/toggle-status',
        [UserController::class, 'toggleStatus'])
        ->name('users.toggle-status');
});




Route::middleware(['auth'])->group(function () {

    Route::post(
        'accounts/{account}/toggle-status',
        [AccountController::class, 'toggleStatus']
    )->name('accounts.toggle-status');

    Route::resource('accounts', AccountController::class);

});

require __DIR__.'/auth.php';
