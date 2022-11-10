<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTransactionRequest;
use Src\Application\Transaction\CreateTransaction;
use Src\Application\Transaction\GetBalances;
use Src\Domain\Coin\CoinGeckoId;
use Src\Domain\Transaction\TransactionRequest;
use Src\Domain\User\UserId;

class TransactionController extends Controller
{
    public function createTransaction(CreateTransactionRequest $request)
    {
        $userId = 1;

        $transaction = new TransactionRequest(
            userId: new UserId($userId),
            coinGeckoId: new CoinGeckoId($request->coin),
            amount: $request->amount,
            type: $request->type,
        );

        $newTransaction = dispatch_sync(new CreateTransaction($transaction));

        return json_encode($newTransaction);
    }

    public function getBalances()
    {
        $userId = new UserId('1');

        $balances = dispatch_sync(new GetBalances($userId));

        return json_encode($balances);
    }
}
