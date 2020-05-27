<?php

declare(strict_types=1);

namespace App\Application\Shared;

abstract class IntegerIdentifier
{
    private int $identifier;

    public function __construct(int $identifier)
    {
        $this->identifier = $identifier;
    }

    public function toInt(): int
    {
        return $this->identifier;
    }
}
