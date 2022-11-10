<?php

use App\Http\Controllers\CoinController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('coins', [CoinController::class, 'showCoins'])->middleware('auth');
Route::get('transactions/{coinGeckoId}', [TransactionController::class, 'createTransaction'])->middleware('auth');
Route::post('transactions', [TransactionController::class, 'storeTransaction'])->middleware('auth');
Route::get('balances', [TransactionController::class, 'showBalances'])->middleware('auth');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
