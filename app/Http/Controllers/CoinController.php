<?php

namespace App\Http\Controllers;

use Src\Application\CoinGecko\GetCoins;

class CoinController extends Controller
{
    public function getCoins()
    {
        return json_encode(dispatch_sync(new GetCoins));
    }
}
