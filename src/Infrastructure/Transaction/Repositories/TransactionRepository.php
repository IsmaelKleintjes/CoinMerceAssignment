<?php
namespace Src\Infrastructure\Transaction\Repositories;

use Src\Application\Transaction\Contracts\TransactionRepository as TransactionRepositoryContract;
use App\Models\Transaction as TransactionEloquent;
use Src\Domain\Coin\Coin;
use Src\Domain\Coin\CoinGeckoId;
use Src\Domain\Transaction\Transaction;
use Src\Domain\Transaction\TransactionEntityCollection;
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
                'price_change_percentage_1h' => $transactionInfo->coin->price_change_percentage_1h,
                'price_change_percentage_24h' => $transactionInfo->coin->price_change_percentage_7d,
                'price_change_percentage_7d' => $transactionInfo->coin->price_change_percentage_24h,
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

    public function fetchAll(): TransactionEntityCollection
    {
        $transactions = TransactionEloquent::where('user_id','1')->get();

        $TransactioEntityCollection = new TransactionEntityCollection();

        $transactions->map(function ($transaction) use ($TransactioEntityCollection) {
            $transactionEntity = new TransactionEntity(
                transactionId: new TransactionId($transaction->id),
                userId: new UserId($transaction->user_id),
                coin: new Coin(
                    coinGeckoId: new CoinGeckoId($transaction->coin_id),
                    current_price: $transaction->price,
                    price_change_percentage_1h: $transaction->price_change_percentage_1h,
                    price_change_percentage_24h: $transaction->price_change_percentage_24h,
                    price_change_percentage_7d: $transaction->price_change_percentage_7d,
                ),
                amount: $transaction->amount,
            );

            $TransactioEntityCollection->addObject($transactionEntity);
        });

        return $TransactioEntityCollection;
    }
}
