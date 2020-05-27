<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared;

use App\Application\Shared\ProcessId;
use App\Application\Shared\State;
use App\Application\Shared\StateRepository;

final class InMemoryStateRepository implements StateRepository
{
    private array $storage = [];

    public function find(ProcessId $id): ?State
    {
        return $this->storage[$id->toInt()] ?? null;
    }

    public function save(State $state): void
    {
        $this->storage[$state->getId()->toInt()] = $state;
    }
}
