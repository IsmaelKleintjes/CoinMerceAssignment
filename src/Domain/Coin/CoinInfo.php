<?php

namespace Src\Domain\Coin;

class CoinInfo
{
    public function __construct(
        public readonly Coin  $coin,
        public readonly float $currentPrice,
        public readonly float $priceChangePercentage1h,
        public readonly float $priceChangePercentage24h,
        public readonly float $priceChangePercentage7d,
    ){
    }
}
