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

Route::get('/', function () {return view('welcome');});
Route::get('coins', [CoinController::class, 'showCoins']);
Route::get('transactions/{coinGeckoId}', [TransactionController::class, 'createTransaction']);
Route::post('transactions', [TransactionController::class, 'storeTransaction']);
Route::get('balances', [TransactionController::class, 'showBalances']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
