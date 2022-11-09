<?php
namespace Src\Application\Transaction\Contracts;

use Src\Domain\Transaction\Transaction;
use Src\Domain\Transaction\TransactionEntity;
use Src\Domain\Transaction\TransactionEntityCollection;

interface TransactionRepository
{
    public function persist(Transaction $transactionInfo): TransactionEntity;
    public function fetchAll(): TransactionEntityCollection;
}
