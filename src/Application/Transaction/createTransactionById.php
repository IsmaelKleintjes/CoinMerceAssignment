<?php

namespace Src\Application\Transaction;

use Src\Application\Contracts\Command;
use Src\Application\CoinGecko\Contracts\CoinGeckoRepository;
use Src\Application\Transaction\Contracts\TransactionRepository;
use Src\Domain\Coin\CoinGeckoId;
use Src\Domain\Transaction\Transaction;
use Src\Domain\Transaction\TransactionEntity;
use Src\Domain\User\UserId;

class createTransactionById implements Command
{
    public function __construct(private CoinGeckoId $coinGeckoId, $value){
    }

    public function handle(TransactionRepository $transactionRepository, CoinGeckoRepository $coinGeckoRepository): TransactionEntity
    {
        $amount = 0000.1;
        $coin = $coinGeckoRepository->fetchCoinById($this->coinGeckoId);

        $transaction = new Transaction(
            userId: new UserId(1),
            coin: $coin,
            amount: $amount,
        );

        return $transactionRepository->persist($transaction);
    }
}
