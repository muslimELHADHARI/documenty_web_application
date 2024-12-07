<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\QuoteController;

Route::get('/test', function () {
    return view('test');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'loginPost'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [ItemController::class, 'index'])->name('home');
    Route::post('/newpost', [ItemController::class, 'store'])->name('store.item');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/api/random-quote', [QuoteController::class, 'getRandomQuote']);
    Route::get('/search', [SearchController::class, 'search'])->name('search');
    Route::get('/items/{id}', [ItemController::class, 'show'])->name('items.show');
    Route::get('/items', [ItemController::class, 'index'])->name('items.index');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
});
