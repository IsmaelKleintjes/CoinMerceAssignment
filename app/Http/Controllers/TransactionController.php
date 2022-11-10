<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTransactionRequest;
use Illuminate\Support\Facades\Auth;
use Src\Application\Transaction\CreateTransaction;
use Src\Application\Transaction\GetBalances;
use Src\Domain\Coin\CoinGeckoId;
use Src\Domain\Transaction\TransactionRequest;
use Src\Domain\User\UserId;

class TransactionController extends Controller
{
    public function showBalances()
    {
        $userId = new UserId(Auth::user()->id);

        $balances = dispatch_sync(new GetBalances($userId));

        return view('Balances.show', [
            'balances' => $balances
        ]);
    }

    public function createTransaction($request)
    {
        return view('transactions.create', [
            'coin' => $request
        ]);
    }

    public function storeTransaction(CreateTransactionRequest $request)
    {
        $transaction = new TransactionRequest(
            userId: new UserId(Auth::user()->id),
            coinGeckoId: new CoinGeckoId($request->coin),
            amount: $request->amount,
            type: $request->type,
        );

        $newTransaction = dispatch_sync(new CreateTransaction($transaction));

        return view('transactions.show', [
            'transaction' => $newTransaction
        ]);
    }

    public function getBalances()
    {
        $userId = new UserId(Auth::user()->id);

        $balances = dispatch_sync(new GetBalances($userId));

        return json_encode($balances);
    }
}
