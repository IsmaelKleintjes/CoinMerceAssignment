<?php

namespace Src\Application\CoinGecko;

use Src\Application\Contracts\Command;
use Src\Application\CoinGecko\Contracts\CoinGeckoRepository;
use Src\Domain\Coin\CoinCollection;

class getCoins implements Command
{
    public function __construct(){
    }

    public function handle(CoinGeckoRepository $coinGeckoRepository): CoinCollection
    {
        $coinCollection = $coinGeckoRepository->fetchCoin();

        return $coinCollection;
    }
}
