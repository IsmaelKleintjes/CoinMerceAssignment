<?php

namespace Src\Application\CoinGecko;

use Src\Application\Coin\Contracts\CoinRepository;
use Src\Application\CoinGecko\Contracts\CoinGeckoRepository;
use Src\Application\Contracts\Query;
use Src\Domain\Coin\CoinInfoCollection;

class GetCoins implements Query
{
    public function __construct(){
    }

    public function handle(CoinGeckoRepository $coinGeckoRepository, CoinRepository $coinRepository): CoinInfoCollection
    {
        $coins = $coinRepository->fetchAll();

        $coinsList='';

        foreach ($coins->list as $coin){
            $coinsList .=  $coin->coinGeckoId->id.',';
        }

        $coinInfoCollection = $coinGeckoRepository->fetchCoins($coinsList);

        return $coinInfoCollection;
    }
}
