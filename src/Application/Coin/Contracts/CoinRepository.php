<?php
namespace Src\Application\Coin\Contracts;

use Src\Domain\Coin\CoinEntityCollection;

interface CoinRepository
{
    public function fetchAll(): ?CoinEntityCollection;
}
