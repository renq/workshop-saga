<?php

declare(strict_types=1);

namespace App\Reservation;

use App\Reservation\Event\RoomId;
use App\Reservation\Event\UserId;
use App\Shared\Period;
use App\Shared\State;
use App\Shared\ProcessId;

final class ReservationState implements State
{
    private ProcessId $id;

    public ?UserId $userId;
    public ?RoomId $roomId;
    public ?Period $reservationPeriod;

    public function __construct(ProcessId $id)
    {
        $this->id = $id;
    }
}
