<?php

namespace Src\Domain\Transaction;

use Src\Domain\Coin\CoinGeckoId;
use Src\Domain\User\UserId;

class TransactionRequest
{
    public function __construct(
        public readonly UserId $userId,
        public readonly CoinGeckoId $coinGeckoId,
        public readonly float $amount,
        public readonly string $type,
    ){
    }
}
