<?php
namespace Src\Infrastructure\Coin;

use Src\Application\Coin\Contracts\CoinRepository as CoinRepositoryContract;
use App\Models\Coin as CoinEloquent;
use Src\Domain\Coin\CoinGeckoId;
use Src\Domain\Coin\CoinEntityCollection;
use Src\Domain\Coin\CoinEntity;
use Src\Domain\Coin\CoinId;

final class CoinRepository implements CoinRepositoryContract
{
    public function fetchAll(): ?CoinEntityCollection
    {
        $coins = CoinEloquent::get();

        if($coins->isEmpty()){
            return null;
        }


        $coinEntityCollection = new CoinEntityCollection();

        $coins->map(function ($coin) use ($coinEntityCollection) {

            $coinEntity = new CoinEntity(
                id: new CoinId($coin->id),
                coinGeckoId: new CoinGeckoId($coin->coingecko_id),
                name: $coin->name,
                symbol: $coin->symbol,
            );

            $coinEntityCollection->addObject($coinEntity);
        });

        return $coinEntityCollection;
    }
}
