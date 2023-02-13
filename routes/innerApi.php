<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\DeckController;
use App\Http\Controllers\GifController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TranslatorController;
use App\Http\Controllers\WordController;
use Illuminate\Support\Facades\Route;

Route::get('/translation/{word}', [TranslatorController::class, 'translate'])->name('translator');

Route::get('/gif/search/{word}/{limit?}/{offset?}/{lang?}', [GifController::class, 'search'])->name('searchGif');
Route::get('/gif/random/{tag?}', [GifController::class, 'random'])->name('randomGif');

Route::post('/word/create', [WordController::class, 'create'])->name('createWord');

Route::post('/card/create', [CardController::class, 'create'])->name('createCard');
Route::get('/card/getCards', [CardController::class, 'getCards'])->name('getCards');
Route::get('/card/delete/{id}', [CardController::class, 'delete'])->name('deleteCard');

Route::post('deck/create', [DeckController::class, 'create'])->name('createDeck');
Route::get('/deck/getDecks', [DeckController::class, 'getDecks'])->name('getDecks');
Route::get('/deck/delete/{id}', [DeckController::class, 'delete'])->name('deleteDeck');

Route::get('/profile/balance', [ProfileController::class, 'getBalance'])->name('profile.balance');
