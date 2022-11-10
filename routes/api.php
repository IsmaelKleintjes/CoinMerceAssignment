<?php

use App\Http\Controllers\CoinController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('coins', [CoinController::class, 'getCoins']);
Route::post('transactions', [TransactionController::class, 'storeTransaction']);
Route::get('balances', [TransactionController::class, 'getBalances']);

