<?php

namespace Src\Domain\Balance;

class BalanceCollection
{
    private array $array;

    public function __construct(Balance ...$balance)
    {
        $this->array = $balance;
    }

    public function addObject(Balance $balance): void
    {
        $this->list[] = $balance;
    }
}
