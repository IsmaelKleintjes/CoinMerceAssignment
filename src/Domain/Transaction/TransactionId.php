<?php

namespace Src\Domain\Transaction;

class TransactionId
{
    public function __construct(
        public int $id,
    )
    {}
}
