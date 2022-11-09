<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Infrastructure\CoinGecko\Repositories\CoinGeckoRepository;
use Src\Application\CoinGecko\Contracts\CoinGeckoRepository as CoinGeckoRepositoryContract;
use Src\Infrastructure\Transaction\Repositories\TransactionRepository;
use Src\Application\Transaction\Contracts\TransactionRepository as TransactionRepositoryContract;

final class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->scoped(CoinGeckoRepositoryContract::class, CoinGeckoRepository::class);
        $this->app->scoped(TransactionRepositoryContract::class, TransactionRepository::class);
    }
}
