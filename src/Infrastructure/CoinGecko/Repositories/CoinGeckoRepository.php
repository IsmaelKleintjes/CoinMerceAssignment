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
        $coins = 'bitcoin,ethereum,cardano,tether';
        $response = Http::get('https://api.coingecko.com/api/v3/coins/markets?vs_currency=eur&ids=' . $coins . '&order=market_cap_desc&per_page=100&page=1&sparkline=false&price_change_percentage=1h,24h,7d');
        $coins = collect(json_decode($response->body()));

        $coinCollection = new CoinCollection();

        $coins->map(function ($coin) use ($coinCollection) {
            $coinObject = new Coin(
                coinGeckoId: new CoinGeckoId($coin->id),
                current_price: $coin->current_price,
                price_change_percentage_1h: $coin->price_change_percentage_1h_in_currency,
                price_change_percentage_24h: $coin->price_change_percentage_24h_in_currency,
                price_change_percentage_7d: $coin->price_change_percentage_24h_in_currency
            );

            $coinCollection->addObject($coinObject);
        });

        return $coinCollection;
    }

    public function fetchCoinById(CoinGeckoId $coinGeckoId): Coin
    {
        $response = Http::get('https://api.coingecko.com/api/v3/coins/markets?vs_currency=eur&ids=' . $coinGeckoId->id . '&order=market_cap_desc&per_page=100&page=1&sparkline=false&price_change_percentage=1h,24h,7d');
        $coin = collect(json_decode($response->body()))[0];

        return new Coin(
            coinGeckoId: new CoinGeckoId($coin->id),
            current_price: $coin->current_price,
            price_change_percentage_1h: $coin->price_change_percentage_1h_in_currency,
            price_change_percentage_24h: $coin->price_change_percentage_24h_in_currency,
            price_change_percentage_7d: $coin->price_change_percentage_24h_in_currency
        );
    }
}
