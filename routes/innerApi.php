<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\DeckController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::post('/card/create', [CardController::class, 'create'])->name('createCard');
Route::get('/card/getCards', [CardController::class, 'getCards'])->name('getCards');
Route::get('/card/delete/{id}', [CardController::class, 'delete'])->name('deleteCard');
Route::post('/card/addToDeck', [CardController::class, 'addCardToDeck'])->name('addCardToDeck');
Route::post('/card/removeCardFromDeck', [CardController::class, 'removeCardFromDeck'])->name('removeCardFromDeck');

Route::post('deck/create', [DeckController::class, 'create'])->name('createDeck');
Route::get('/deck/getDecks', [DeckController::class, 'getDecks'])->name('getDecks');
Route::get('/deck/delete/{id}', [DeckController::class, 'delete'])->name('deleteDeck');
Route::get('/deck/{id}/cards', [DeckController::class, 'getCards'])->name('getCardsInDeck');

Route::get('/profile/balance', [ProfileController::class, 'getBalance'])->name('profile.balance');
