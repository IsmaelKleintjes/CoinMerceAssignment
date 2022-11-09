<?php

namespace Src\Domain\Transaction;

use Src\Domain\Coin\Coin;
use Src\Domain\User\UserId;

class TransactionEntity
{
    public function __construct(
        public TransactionId $transactionId,
        public userId $userId,
        public Coin $coin,
        public float $amount,
    )
    {
    }
}
