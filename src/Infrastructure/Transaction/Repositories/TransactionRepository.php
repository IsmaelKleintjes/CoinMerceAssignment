<?php
namespace Src\Infrastructure\Transaction\Repositories;

use Src\Application\Transaction\Contracts\TransactionRepository as TransactionRepositoryContract;
use App\Models\Transaction as TransactionEloquent;
use Src\Domain\Transaction\Transaction;
use Src\Domain\Transaction\TransactionEntity;
use Src\Domain\Transaction\TransactionId;
use Src\Domain\User\UserId;

final class TransactionRepository implements TransactionRepositoryContract
{
    public function persist(Transaction $transactionInfo): TransactionEntity
    {
        $transaction = TransactionEloquent::create(
            [
                'user_id' => $transactionInfo->userId->id,
                'coin_id' => $transactionInfo->coin->coinGeckoId->id,
                'price' => $transactionInfo->coin->current_price,
                'amount' => $transactionInfo->amount
            ]
        );

        return new TransactionEntity(
            transactionId: new TransactionId($transaction->id),
            userId: new UserId($transaction->user_id),
            coin: $transactionInfo->coin,
            amount: $transaction->amount,
        );
    }

    public function fetchAll()
    {

    }
}
