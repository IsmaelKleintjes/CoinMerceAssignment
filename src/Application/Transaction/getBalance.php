<?php

namespace Src\Application\Transaction;

use Src\Application\Contracts\Command;
use Src\Application\CoinGecko\Contracts\CoinGeckoRepository;
use Src\Application\Transaction\Contracts\TransactionRepository;
use Src\Domain\Balance\Balance;
use Src\Domain\Balance\BalanceCollection;
use Src\Domain\Coin\CoinGeckoId;

class getBalance implements Command
{
    public function __construct(){
    }

    public function handle(TransactionRepository $transactionRepository, CoinGeckoRepository $coinGeckoRepository): BalanceCollection
    {
        $transactionsCollection = $transactionRepository->fetchAll();

        $balanceCollection = new BalanceCollection();

        $coins = array('bitcoin','cardano','ethereum','tether');
        foreach ($coins as $coin)
        {
            $i = 0;
            $total_crypto = 0;
            $price_old = 0;
            foreach($transactionsCollection->list as $transaction)
            {
                if($transaction->coin->coinGeckoId->id == $coin)
                {
                    $i += 1;
                    $total_crypto += $transaction->amount;
                    $price_old += $transaction->coin->current_price;
                }
            }

            if($total_crypto > 0) {
                $price_old = $price_old / $i;
                $current_coin = $coinGeckoRepository->fetchCoinById(new CoinGeckoId($coin));
                $total_fiat = $total_crypto * $current_coin->current_price;

                $balanceObject = new Balance(
                    coinGeckoId: new CoinGeckoId($coin),
                    totalAmount: $total_crypto,
                    totalFiat: $total_fiat,
                    percentage: ($total_fiat / ($total_crypto * $price_old)) * 100 - 100
                );

                $balanceCollection->addObject($balanceObject);
            }
        }

        return $balanceCollection;
    }
}
