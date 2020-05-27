<?php

declare(strict_types=1);

namespace App\Application\Shared;

use DateTimeImmutable;
use InvalidArgumentException;

final class Period
{
    private DateTimeImmutable $from;
    private DateTimeImmutable $to;

    public function __construct(DateTimeImmutable $from, DateTimeImmutable $to)
    {
        if ($from >= $to) {
            throw new InvalidArgumentException('$to must be greater than $from.');
        }

        $this->from = $from;
        $this->to = $to;
    }

    public function getFrom(): DateTimeImmutable
    {
        return $this->from;
    }

    public function getTo(): DateTimeImmutable
    {
        return $this->to;
    }
}
