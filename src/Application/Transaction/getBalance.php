<?php

namespace Src\Application\Transaction;

use Src\Application\Contracts\Command;
use Src\Application\CoinGecko\Contracts\CoinGeckoRepository;
use Src\Application\Transaction\Contracts\TransactionRepository;
use Src\Domain\Transaction\TransactionEntity;


class getBalance implements Command
{
    public function __construct(){
    }

    public function handle(TransactionRepository $transactionRepository, CoinGeckoRepository $coinGeckoRepository): TransactionEntity
    {
        $transactionsCollection = $transactionRepository->fetchAll();
    }
}
