<?php

namespace Src\Domain\Balance;

use Src\Domain\Coin\CoinGeckoId;

class Balance
{
    public function __construct(
        public CoinGeckoId $coinGeckoId,
        public $totalAmount,
        public $totalFiat,
        public $percentage,
    )
    {}
}
