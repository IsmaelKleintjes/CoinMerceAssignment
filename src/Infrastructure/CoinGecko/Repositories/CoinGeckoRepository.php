<?php
namespace Src\Infrastructure\CoinGecko\Repositories;

use Illuminate\Support\Facades\Http;
use Src\Application\CoinGecko\Contracts\CoinGeckoRepository as CoinGeckoRepositoryContract;
use Src\Domain\Coin\Coin;
use Src\Domain\Coin\CoinInfo;
use Src\Domain\Coin\CoinInfoCollection;
use Src\Domain\Coin\CoinGeckoId;

final class CoinGeckoRepository implements CoinGeckoRepositoryContract
{
    public function fetchCoins(string $coinGeckoIds): CoinInfoCollection
    {
        $coins = $this->apiCall($coinGeckoIds);

        $coinInfoCollection = new CoinInfoCollection();

        $coins->map(function ($coin) use ($coinInfoCollection) {

            $coinObject = new CoinInfo(
                coin: new Coin(
                    coinGeckoId: new CoinGeckoId($coin->id),
                    name: $coin->name,
                    symbol: $coin->symbol,
                ),
                currentPrice: $coin->current_price,
                priceChangePercentage1h: $coin->price_change_percentage_1h_in_currency,
                priceChangePercentage24h: $coin->price_change_percentage_24h_in_currency,
                priceChangePercentage7d: $coin->price_change_percentage_24h_in_currency
            );

            $coinInfoCollection->addObject($coinObject);
        });

        return $coinInfoCollection;
    }

    public function fetchCoin(CoinGeckoId $coinGeckoId): CoinInfo
    {
        $coin = $this->apiCall($coinGeckoId->id)[0];

        return new CoinInfo(
            coin: new Coin(
                coinGeckoId: new CoinGeckoId($coin->id),
                name: $coin->name,
                symbol: $coin->symbol,
            ),
            currentPrice: $coin->current_price,
            priceChangePercentage1h: $coin->price_change_percentage_1h_in_currency,
            priceChangePercentage24h: $coin->price_change_percentage_24h_in_currency,
            priceChangePercentage7d: $coin->price_change_percentage_24h_in_currency
        );
    }

    private function apiCall(string $ids)
    {
        $response = Http::get('https://api.coingecko.com/api/v3/coins/markets?vs_currency=eur&ids=' . $ids . '&order=market_cap_desc&per_page=100&page=1&sparkline=false&price_change_percentage=1h,24h,7d');
        return collect(json_decode($response->body()));
    }
}
