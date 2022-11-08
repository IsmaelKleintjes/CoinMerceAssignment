<?php
namespace Src\Infrastructure\CoinGecko\Repositories;

use Illuminate\Support\Facades\Http;
use Src\Application\CoinGecko\Contracts\CoinGeckoRepository as CoinGeckoRepositoryContract;
use Src\Domain\Coin\Coin;
use Src\Domain\Coin\CoinCollection;
use Src\Domain\Coin\CoinGeckoId;

final class CoinGeckoRepository implements CoinGeckoRepositoryContract
{
    public function fetchCoin(): CoinCollection
    {
        $coinCollection = new CoinCollection();

        $coins = collect(array('bitcoin', 'ethereum', 'cardano', 'tether'));
        $coins->map(function ($coin) use ($coinCollection) {
            $response = Http::get('https://api.coingecko.com/api/v3/coins/' . $coin);
            $coinInfo = json_decode($response->body());
            $marketdata = $coinInfo->market_data;

            $coinObject = new Coin(
                coinGeckoId: new CoinGeckoId($coinInfo->id),
                current_price: $marketdata->current_price->eur,
                price_change_percentage_24h: $marketdata->price_change_percentage_24h,
                price_change_percentage_7d: $marketdata->price_change_percentage_7d,
                price_change_percentage_30d: $marketdata->price_change_percentage_30d
            );

            $coinCollection->addObject($coinObject);
        });

        return $coinCollection;
    }
}
