<?php

declare(strict_types=1);

namespace App\Application\Shared;

interface CommandBus
{
    public function dispatch(object ...$command): void;
}
