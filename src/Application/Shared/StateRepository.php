<?php

declare(strict_types=1);

namespace App\Application\Shared;

interface StateRepository
{
    public function find(ProcessId $id): ?State;

    public function save(State $state): void;
}
