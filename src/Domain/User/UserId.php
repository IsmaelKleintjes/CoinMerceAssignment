<?php

namespace Src\Domain\User;

class UserId
{
    public function __construct(
        public int $id,
    )
    {}
}
