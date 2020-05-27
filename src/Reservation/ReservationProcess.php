<?php

declare(strict_types=1);

namespace App\Reservation;

use App\Reservation\Event\ReservationRequested;
use App\Shared\Event;
use App\Shared\Process;
use App\Shared\ProcessResult;
use App\Shared\State;
use LogicException;

final class ReservationProcess implements Process
{
    public function handle(Event $event, State $state): ProcessResult
    {
        /** @var ReservationState $state */

        switch (get_class($event)) {
            case ReservationRequested::class:

            default:
                throw new LogicException("Unknown event{$event}");
        }

        return new ProcessResult($state, []);
    }
}
