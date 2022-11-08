<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Infrastructure\CoinGecko\Repositories\CoinGeckoRepository;
use Src\Application\CoinGecko\Contracts\CoinGeckoRepository as CoinGeckoRepositoryContract;


final class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->scoped(CoinGeckoRepositoryContract::class, CoinGeckoRepository::class);
    }
}
