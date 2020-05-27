<?php

declare(strict_types=1);

namespace App\Shared;

interface Process
{
    public function handle(Event $event, State $state): ProcessResult;
}
