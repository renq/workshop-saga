<?php

declare(strict_types=1);

namespace App\Application\Shared;

abstract class State
{
    private ProcessId $id;

    public function __construct(ProcessId $id)
    {
        $this->id = $id;
    }

    public function getId(): ProcessId
    {
        return $this->id;
    }
}
