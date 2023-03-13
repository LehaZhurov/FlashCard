<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranslatorController;
use App\Http\Controllers\GifController;
use App\Http\Controllers\WordController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/translation/{word}', [TranslatorController::class, 'translate'])->name('translator');

Route::get('/gif/search/{word}/{limit?}/{offset?}/{lang?}', [GifController::class, 'search'])->name('searchGif');
Route::get('/gif/random/{tag?}', [GifController::class, 'random'])->name('randomGif');

Route::post('/word/create', [WordController::class, 'create'])->name('createWord');