<?php
namespace Src\Application\Transaction\Contracts;

use Src\Domain\Balance\Balance;
use Src\Domain\Coin\CoinEntity;
use Src\Domain\Transaction\Price;
use Src\Domain\Transaction\Transaction;
use Src\Domain\Transaction\TransactionEntity;
use Src\Domain\User\UserId;

interface TransactionRepository
{
    public function persist(Transaction $transactionInfo): TransactionEntity;

    public function calculateBalance(CoinEntity $coin, UserId $userId, Price $price): ?Balance;
}
