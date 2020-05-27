<?php

declare(strict_types=1);

namespace App\Reservation\Event;

use App\Shared\Event;
use App\Shared\Period;

final class ReservationRequested implements Event
{
    private UserId $userId;
    private RoomId $roomId;
    private Period $reservationPeriod;

    public function __construct(UserId $userId, RoomId $roomId, Period $reservationPeriod)
    {
        $this->userId = $userId;
        $this->roomId = $roomId;
        $this->reservationPeriod = $reservationPeriod;
    }

    public function getUserId(): UserId
    {
        return $this->userId;
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
