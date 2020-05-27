<?php

declare(strict_types=1);

namespace App\Application\Reservation\Command;

use App\Application\Reservation\RoomId;
use App\Application\Shared\Period;

final class LockRoom
{
    private RoomId $roomId;
    private Period $reservationPeriod;

    public function __construct(RoomId $roomId, Period $reservationPeriod)
    {
        $this->roomId = $roomId;
        $this->reservationPeriod = $reservationPeriod;
    }

    public function getRoomId(): RoomId
    {
        return $this->roomId;
    }

    public function getReservationPeriod(): Period
    {
        return $this->reservationPeriod;
    }
}
