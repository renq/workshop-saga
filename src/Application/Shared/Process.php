<?php

declare(strict_types=1);

namespace App\Application\Shared;

interface Process
{
    public function handle(ProcessEvent $event, ?State $state): ProcessResult;

    public function supports(ProcessEvent $event): bool;
}
