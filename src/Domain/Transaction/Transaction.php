<?php

namespace Src\Domain\Transaction;

use Src\Domain\Coin\Coin;
use Src\Domain\User\UserId;

class Transaction
{
    public function __construct(
        public readonly UserId $userId,
        public readonly Coin $coin,
        public readonly float $amount,
        public readonly string $type,
        public readonly float $price,
    ){
    }
}
