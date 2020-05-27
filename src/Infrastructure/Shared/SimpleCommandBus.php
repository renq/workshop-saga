<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared;

use App\Application\Shared\CommandBus;

final class SimpleCommandBus implements CommandBus
{
    private array $dispatchedCommands = [];

    public function dispatch(object ...$commands): void
    {
        foreach ($commands as $command) {
            $this->dispatchedCommands[] = $command;
        }
    }

    public function getDispatchedCommands(): array
    {
        return $this->dispatchedCommands;
    }
}
