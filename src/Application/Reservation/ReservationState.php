<?php

declare(strict_types=1);

namespace App\Application\Reservation;

use App\Application\Shared\Period;
use App\Application\Shared\State;

final class ReservationState extends State
{
    public ?UserId $userId;
    public ?RoomId $roomId;
    public ?Period $reservationPeriod;
    public ?RoomLockId $roomLockId;
}
