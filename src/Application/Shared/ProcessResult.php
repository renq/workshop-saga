<?php

declare(strict_types=1);

namespace App\Application\Shared;

final class ProcessResult
{
    /** @var object[] */
    private array $commands;

    private State $state;

    public function __construct(State $state, array $commands)
    {
        $this->state = $state;
        $this->commands = $commands;
    }

    /**
     * @return object[]
     */
    public function getCommands(): array
    {
        return $this->commands;
    }

    public function getState(): State
    {
        return $this->state;
    }
}
