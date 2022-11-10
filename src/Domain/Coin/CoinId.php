<?php

namespace Src\Domain\Coin;

class CoinId
{
    public function __construct(
        public readonly string $id,
    ){
    }
}
