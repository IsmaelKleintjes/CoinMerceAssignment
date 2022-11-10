<?php

namespace Src\Domain\Coin;

class CoinEntity
{
    public function __construct(
        public readonly CoinId $id,
        public readonly CoinGeckoId $coinGeckoId,
        public readonly string $name,
        public readonly string $symbol,
    ){
    }
}
