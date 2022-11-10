<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTransactionRequest;
use Src\Application\CoinGecko\GetCoins;
use Src\Application\Transaction\CreateTransaction;
use Src\Application\Transaction\GetBalances;
use Src\Domain\Coin\CoinGeckoId;
use Src\Domain\Transaction\TransactionRequest;
use Src\Domain\User\UserId;

class TransactionController extends Controller
{
    public function showBalances()
    {
        $userId = new UserId('1');

        $balances = dispatch_sync(new GetBalances($userId));

        return view('Balances.show', [
            'balances' => $balances->list
        ]);
    }

    public function createTransaction($request)
    {
        $userId = new UserId('1');

        $balances = dispatch_sync(new GetCoins());

        return view('transactions.create', [
            'coin' => $request
        ]);
    }

    public function storeTransaction(CreateTransactionRequest $request)
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
