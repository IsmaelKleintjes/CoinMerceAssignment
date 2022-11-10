<?php

namespace App\Http\Controllers;

use Src\Application\CoinGecko\GetCoins;

class CoinController extends Controller
{
    public function showCoins()
    {
        $coins = dispatch_sync(new GetCoins);

        return view('coins.show', [
            'coins' => $coins->list
        ]);
    }

    public function getCoins()
    {
        return json_encode(dispatch_sync(new GetCoins));
    }
}
