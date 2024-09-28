<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrencyController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/getToken', [CurrencyController::class, 'getToken']);


Route::middleware('check.bearer')->group(function () {
    Route::get('/currencies', [CurrencyController::class, 'index']);
    Route::get('/currencies/{id}', [CurrencyController::class, 'show']);
    Route::get('/currencies/{id}/history', [CurrencyController::class, 'history']);
});
