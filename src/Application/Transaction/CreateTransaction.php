<?php

namespace Src\Application\Transaction;

use Src\Application\Contracts\Command;
use Src\Application\CoinGecko\Contracts\CoinGeckoRepository;
use Src\Application\Transaction\Contracts\TransactionRepository;
use Src\Domain\Coin\Coin;
use Src\Domain\Coin\CoinGeckoId;
use Src\Domain\Transaction\Transaction;
use Src\Domain\Transaction\TransactionEntity;
use Src\Domain\Transaction\TransactionRequest;
use Src\Domain\User\UserId;

class CreateTransaction implements Command
{
    public function __construct(private readonly TransactionRequest $transactionRequest){
    }

    public function handle(TransactionRepository $transactionRepository, CoinGeckoRepository $coinGeckoRepository): TransactionEntity
    {
        $coin = $coinGeckoRepository->fetchCoin($this->transactionRequest->coinGeckoId);
        $transactionRequest = $this->transactionRequest;

        $transaction = new Transaction(
            userId: new UserId($transactionRequest->userId->id),
            coin: new Coin(
                coinGeckoId: $coin->coin->coinGeckoId,
                name: $coin->coin->name,
                symbol: $coin->coin->symbol
            ),
            amount: $transactionRequest->amount,
            type: $transactionRequest->type,
            price:$coin->currentPrice
        );

        return $transactionRepository->persist($transaction);
    }
}
