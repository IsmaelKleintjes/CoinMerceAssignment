<?php

namespace Src\Application\Transaction;

use Src\Application\Coin\Contracts\CoinRepository;
use Src\Application\Contracts\Command;
use Src\Application\CoinGecko\Contracts\CoinGeckoRepository;
use Src\Application\Transaction\Contracts\TransactionRepository;
use Src\Domain\Balance\BalanceCollection;
use Src\Domain\Transaction\Price;
use Src\Domain\User\UserId;

class GetBalances implements Command
{
    public function __construct(private readonly UserId $userId){
    }

    public function handle(TransactionRepository $transactionRepository, CoinRepository $coinRepository, CoinGeckoRepository $coinGeckoRepository): ?BalanceCollection
    {
        $coins = $coinRepository->fetchAll();

        if(!$coins){
            return null;
        }

        $coinsList='';
        foreach ($coins->list as $coin){
            $coinsList .=  $coin->coinGeckoId->id.',';
        }

        $collection = new BalanceCollection();

        foreach ($coins->list as $coin) {

            $coinInfoCollection = $coinGeckoRepository->fetchCoins($coinsList);

            $currentPrice = $this->getCurrentPrice($coinInfoCollection, $coin);

            $balanceCoin = $transactionRepository->calculateBalance($coin, $this->userId, new Price($currentPrice));

            if($balanceCoin){
                $collection->addObject($balanceCoin);
            }
        }

        return $collection;
    }

    private function getCurrentPrice($coinInfoCollection, $coin)
    {
        foreach ($coinInfoCollection->list as $coinInfo){

            if ($coinInfo->coin->coinGeckoId->id == $coin->coinGeckoId->id){

                $currentPrice = $coinInfo->currentPrice;
            }
        }
        return $currentPrice;
    }
}
