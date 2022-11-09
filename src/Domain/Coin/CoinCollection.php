<?php

namespace Src\Domain\Coin;

class CoinCollection
{
    private array $array;

    public function __construct(Coin ...$coin)
    {
        $this->array = $coin;
    }

    public function addObject(Coin $coin): void
    {
        $this->list[] = $coin;
    }
}

