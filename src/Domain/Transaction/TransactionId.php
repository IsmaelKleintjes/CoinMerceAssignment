<?php

namespace Src\Domain\Transaction;

class TransactionId
{
    public function __construct(
        public readonly int $id,
    )
    {}
}
