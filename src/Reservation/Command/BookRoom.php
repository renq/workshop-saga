<?php

declare(strict_types=1);

namespace App\Reservation\Command;

use App\Reservation\Event\RoomId;
use App\Shared\Period;

final class BookRoom
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
