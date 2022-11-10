<?php

namespace Src\Domain\Transaction;

use Src\Domain\Coin\Coin;
use Src\Domain\User\UserId;

class TransactionEntity
{
    public function __construct(
        public readonly TransactionId $transactionId,
        public readonly UserId $userId,
        public readonly Coin $coin,
        public readonly float $amount,
        public readonly float $price,
        public readonly string $type,
    ){
    }
}
