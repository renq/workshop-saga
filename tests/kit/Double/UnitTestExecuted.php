<?php

declare(strict_types=1);

namespace App\Tests\Kit\Double;

use App\Application\Shared\ProcessEvent;
use App\Application\Shared\ProcessId;

final class UnitTestExecuted implements ProcessEvent
{
    private ProcessId $processId;

    public function __construct(ProcessId $processId)
    {
        $this->processId = $processId;
    }

    public function getProcessId(): ProcessId
    {
        return $this->processId;
    }
}
