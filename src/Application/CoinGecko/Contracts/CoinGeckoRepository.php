<?php
namespace Src\Application\CoinGecko\Contracts;

use Src\Domain\Coin\Coin;
use Src\Domain\Coin\CoinGeckoId;

interface CoinGeckoRepository
{
    public function fetchCoin();
    public function fetchCoinById(CoinGeckoId $coinGeckoId): Coin;
}
