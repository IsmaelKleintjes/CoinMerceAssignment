<?php

namespace Src\Domain\Coin;

class Coin
{
    public function __construct(
        public readonly CoinGeckoId $coinGeckoId,
        public readonly string $name,
        public readonly string $symbol,
    ){
    }
}
