<?php

declare(strict_types=1);

namespace App\Application\Reservation;

use App\Application\Reservation\Command\BookRoom;
use App\Application\Reservation\Command\LockRoom;
use App\Application\Reservation\Event\ReservationRequested;
use App\Application\Reservation\Event\RoomLocked;
use App\Application\Shared\ProcessEvent;
use App\Application\Shared\Process;
use App\Application\Shared\ProcessResult;
use App\Application\Shared\State;
use LogicException;

final class ReservationProcess implements Process
{
    public function handle(ProcessEvent $event, ?State $state): ProcessResult
    {
        /** @var ReservationState $state */
        if ($state === null) {
            $state = new ReservationState();
        }

        switch (true) {
            case $event instanceof ReservationRequested:
                $state->userId = $event->getUserId();
                $state->roomId = $event->getRoomId();
                $state->reservationPeriod = $event->getReservationPeriod();

                return new ProcessResult($state, [
                    new LockRoom($event->getRoomId(), $event->getReservationPeriod())
                ]);
            case $event instanceof RoomLocked:
                $state->roomLockId = $event->getRoomLockId();

                return new ProcessResult($state, [
                    new BookRoom($event->getRoomLockId(), $state->userId)
                ]);
            default:
                throw new LogicException('Unknown event ' . get_class($event));
        }
    }

    public function supports(ProcessEvent $event): bool
    {
        return in_array(
            get_class($event),
            [
                ReservationRequested::class,
                RoomLocked::class,
            ]
        );
    }
}
