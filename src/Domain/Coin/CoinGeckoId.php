<?php

namespace Src\Domain\Coin;

class CoinGeckoId
{
    public function __construct(
        public readonly string $id,
    )
    {}
}
