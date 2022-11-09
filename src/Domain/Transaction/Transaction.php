<?php

namespace Src\Domain\Transaction;

use Src\Domain\Coin\Coin;
use Src\Domain\User\UserId;

class Transaction
{
    public function __construct(
        public userId $userId,
        public Coin $coin,
        public float $amount,
    )
    {}
}
