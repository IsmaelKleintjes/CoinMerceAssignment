<?php

namespace Src\Domain\Transaction;

class TransactionEntityCollection
{
    private array $array;

    public function __construct(TransactionEntity ...$transactionEntity)
    {
        $this->array = $transactionEntity;
    }

    public function addObject(TransactionEntity $transactionEntity): void
    {
        $this->list[] = $transactionEntity;
    }
}
