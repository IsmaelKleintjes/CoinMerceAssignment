<?php

namespace Src\Domain\Coin;

class CoinEntityCollection
{
    private array $array;

    public function __construct(CoinEntity ...$coinEntity)
    {
        $this->array = $coinEntity;
    }

    public function addObject(CoinEntity $coinEntity): void
    {
        $this->list[] = $coinEntity;
    }
}

