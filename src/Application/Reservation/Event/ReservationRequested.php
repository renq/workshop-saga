<?php

declare(strict_types=1);

namespace App\Application\Reservation\Event;

use App\Application\Reservation\RoomId;
use App\Application\Reservation\UserId;
use App\Application\Shared\Period;
use App\Application\Shared\ProcessEvent;
use App\Application\Shared\ProcessId;

final class ReservationRequested implements ProcessEvent
{
    private ProcessId $processId;
    private UserId $userId;
    private RoomId $roomId;
    private Period $reservationPeriod;

    public function __construct(ProcessId $processId, UserId $userId, RoomId $roomId, Period $reservationPeriod)
    {
        $this->processId = $processId;
        $this->userId = $userId;
        $this->roomId = $roomId;
        $this->reservationPeriod = $reservationPeriod;
    }

    public function getProcessId(): ProcessId
    {
        return $this->processId;
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
