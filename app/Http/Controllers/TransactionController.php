<?php

namespace App\Http\Controllers;

use Src\Application\Transaction\createTransactionById;
use Src\Application\Transaction\getBalance;
use Src\Domain\Coin\CoinGeckoId;

class TransactionController extends Controller
{
    public function createTransaction($request)
    {
        $value = '00000.1';
        return json_encode(dispatch_sync(new createTransactionById(new CoinGeckoId($request), $value)));
    }

    public function getBalance()
    {
        return json_encode(dispatch_sync(new getBalance()));
    }
}
