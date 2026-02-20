<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ShortUrlController;

Route::get('/', [ShortUrlController::class, 'index'])->name('home');
Route::delete('/short-url/{id}', [ShortUrlController::class, 'destroy'])->name('short-url.destroy');
Route::post('/encurtar', [ShortUrlController::class, 'store'])->name('encurtar');
Route::get('/{short_code}', [ShortUrlController::class, 'redirect'])->name('redirect');
Route::get('/links', [ShortUrlController::class, 'listagem'])->name('links.listagem');
