<?php

declare(strict_types=1);

namespace App\Application\Shared;

interface ProcessEvent
{
    public function getProcessId(): ProcessId;
}
