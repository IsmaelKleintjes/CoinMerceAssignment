<?php

namespace Src\Domain\Coin;

class CoinInfoCollection
{
    private array $array;

    public function __construct(CoinInfo ...$coinInfo)
    {
        $this->array = $coinInfo;
    }

    public function addObject(CoinInfo $coinInfo): void
    {
        $this->list[] = $coinInfo;
    }
}

