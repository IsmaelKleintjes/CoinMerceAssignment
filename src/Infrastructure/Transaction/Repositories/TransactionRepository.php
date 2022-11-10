<?php
namespace Src\Infrastructure\Transaction\Repositories;

use Src\Application\Transaction\Contracts\TransactionRepository as TransactionRepositoryContract;
use App\Models\Transaction as TransactionEloquent;
use App\Models\Coin as CoinEloquent;
use Src\Domain\Balance\Balance;
use Src\Domain\Coin\Coin;
use Src\Domain\Coin\CoinEntity;
use Src\Domain\Coin\CoinGeckoId;
use Src\Domain\Transaction\Price;
use Src\Domain\Transaction\Transaction;
use Src\Domain\Transaction\TransactionEntity;
use Src\Domain\Transaction\TransactionId;
use Src\Domain\User\UserId;

final class TransactionRepository implements TransactionRepositoryContract
{
    public function persist(Transaction $transactionInfo): TransactionEntity
    {
        $coin = CoinEloquent::where('coingecko_id', $transactionInfo->coin->coinGeckoId->id)->first();

        $transaction = TransactionEloquent::create(
            [
                'user_id' => $transactionInfo->userId->id,
                'coin_id' => $coin->id,
                'price' => $transactionInfo->price,
                'amount' => $transactionInfo->amount,
                'type' => $transactionInfo->type
            ]
        );

        return new TransactionEntity(
            transactionId: new TransactionId($transaction->id),
            userId: new UserId($transaction->user_id),
            coin: new Coin(
                coinGeckoId: new CoinGeckoId($coin->coingecko_id),
                name: $coin->name,
                symbol: $coin->symbol,
            ),
            amount: $transaction->amount,
            price: $transaction->price,
            type: $transaction->type,
        );
    }

    public function calculateBalance(CoinEntity $coin, UserId $userId, Price $price): ?Balance
    {
        $transaction = TransactionEloquent::with('coin')
            ->where(['user_id' => $userId->id, 'coin_id' => $coin->id->id])
            ->get();

        if($transaction->isEmpty()){
            return null;
        }

        $averagePrice = $transaction->sum('price') / $transaction->count();
        $totalPayed = $transaction->sum('amount') * $averagePrice;
        $worthNow = $transaction->sum('amount') * $price->amount;

        return new Balance(
            coin: new Coin(
                coinGeckoId: $coin->coinGeckoId,
                name: $coin->name,
                symbol: $coin->symbol
            ),
            totalCryptoAmount: $transaction->sum('amount'),
            currentValue: round($worthNow,2),
            gainLoss: round($worthNow - $totalPayed,2),
            percentageDifference: round(($worthNow - $totalPayed) / $totalPayed * 100,2),
        );
    }
}
