<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ShortUrlController;

use App\Http\Controllers\LoginController;

use App\Http\Controllers\UserController;


Route::get('/', [ShortUrlController::class, 'index'])->name('home');
Route::delete('/short-url/{id}', [ShortUrlController::class, 'destroy'])->name('short-url.destroy');
Route::post('/encurtar', [ShortUrlController::class, 'store'])->name('encurtar');
Route::get('/links', [ShortUrlController::class, 'listagem'])->name('links.listagem');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
	Route::get('/users', [UserController::class, 'index'])->name('users.index');
	Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
	Route::post('/users', [UserController::class, 'store'])->name('users.store');
	Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
	Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
});

Route::get('/{short_code}', [ShortUrlController::class, 'redirect'])->name('redirect');
