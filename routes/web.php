<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\GifController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TranslatorController;
use App\Http\Controllers\WordController;
use Illuminate\Support\Facades\Route;

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
    Route::get('/profile/balance', [ProfileController::class, 'getBalance'])->name('profile.balance');
});

require __DIR__ . '/auth.php';

Route::get('/translation/{word}', [TranslatorController::class, 'translate'])->name('translator');
Route::get('/gif/search/{word}/{limit?}/{offset?}/{lang?}', [GifController::class, 'search'])->name('searchGif');
Route::get('/gif/random/{tag?}', [GifController::class, 'random'])->name('randomGif');
Route::post('/word/create', [WordController::class, 'create'])->name('createWord');
Route::post('/card/create', [CardController::class, 'create'])->name('createCard');
Route::get('/card/getCards', [CardController::class, 'getCards'])->name('getCards');
