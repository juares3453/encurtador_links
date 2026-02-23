<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ShortUrlController;

use App\Http\Controllers\LoginController;

Route::get('/', [ShortUrlController::class, 'index'])->name('home');
Route::delete('/short-url/{id}', [ShortUrlController::class, 'destroy'])->name('short-url.destroy');
Route::post('/encurtar', [ShortUrlController::class, 'store'])->name('encurtar');
Route::get('/links', [ShortUrlController::class, 'listagem'])->name('links.listagem');
Route::get('/{short_code}', [ShortUrlController::class, 'redirect'])->name('redirect');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
