<?php

declare(strict_types=1);

namespace App\Tests\Kit\Double;

use App\Application\Shared\ProcessEvent;
use App\Application\Shared\Process;
use App\Application\Shared\ProcessResult;
use App\Application\Shared\State;

final class SampleProcess implements Process
{
    public function handle(ProcessEvent $event, ?State $state): ProcessResult
    {
        return new ProcessResult(
            new SampleState($event->getProcessId()),
            [new DoValidAssertion()]
        );
    }

    public function supports(ProcessEvent $event): bool
    {
        return $event instanceof UnitTestExecuted;
    }
}
