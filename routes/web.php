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
Route::get('coins/list', [CoinController::class, 'getCoins']);
Route::post('transactions/{coinGeckoId}', [TransactionController::class, 'createTransaction']);
Route::get('balances', [TransactionController::class, 'getBalances']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
