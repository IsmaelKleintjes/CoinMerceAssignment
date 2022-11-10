<?php
namespace Src\Application\CoinGecko\Contracts;

use Src\Domain\Coin\CoinGeckoId;
use Src\Domain\Coin\CoinInfo;
use Src\Domain\Coin\CoinInfoCollection;

interface CoinGeckoRepository
{
    public function fetchCoins(string $coinGeckoIds): CoinInfoCollection;

    public function fetchCoin(CoinGeckoId $id): CoinInfo;
}
