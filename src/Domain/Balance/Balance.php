<?php

namespace Src\Domain\Balance;


use Src\Domain\Coin\Coin;

class Balance
{
    public function __construct(
        public readonly Coin $coin,
        public readonly string $totalCryptoAmount,
        public readonly string $gainLoss,
        public readonly string $percentageDifference,
    ){
    }
}
