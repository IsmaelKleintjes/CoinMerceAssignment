<?php

namespace Src\Domain\Transaction;

class Price
{
    public function __construct(
        public readonly float $amount,
    )
    {}
}
