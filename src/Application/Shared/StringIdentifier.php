<?php

declare(strict_types=1);

namespace App\Application\Shared;

abstract class StringIdentifier
{
    private string $identifier;

    public function __construct(string $identifier)
    {
        $this->identifier = $identifier;
    }

    public function toString(): string
    {
        return $this->identifier;
    }
}
