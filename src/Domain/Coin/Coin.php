<?php

namespace Src\Domain\Coin;

class Coin
{
    public function __construct(
        public CoinGeckoId $coinGeckoId,
        public float $current_price,
        public float $price_change_percentage_24h,
        public float $price_change_percentage_7d,
        public float $price_change_percentage_30d,
    )
    {}
}
