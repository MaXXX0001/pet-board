<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PetController::class, 'index'])->name('home');

Route::middleware('guest')->group(function () {

    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'store'])->name('login.store');

    });

Route::middleware('auth')->group(function () {
    Route::delete('/logout', [LoginController::class, 'destroy'])->name('logout');
    Route::delete('login', [LoginController::class, 'destroy'])->name('login.destroy');

});

Route::prefix('pets')->group(function () {
    Route::get('create', [PetController::class, 'create'])->name('pets.create');
    Route::post('store', [PetController::class, 'store'])->name('pets.store');
    Route::get('{pet}', [PetController::class, 'show'])->name('pets.show');
    Route::put('{pet}', [PetController::class, 'approve'])->name('pets.approve');
    Route::get('{pet}/edit', [PetController::class, 'edit'])->name('pets.edit');
    Route::put('{pet}/edit', [PetController::class, 'update'])->name('pets.update');
    Route::delete('{pet}', [PetController::class, 'destroy'])->name('pets.destroy');
});

Route::prefix('comments')->group(function () {
    Route::post('/', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');
});
