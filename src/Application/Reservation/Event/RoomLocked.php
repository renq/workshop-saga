<?php

declare(strict_types=1);

namespace App\Application\Reservation\Event;

use App\Application\Reservation\RoomLockId;
use App\Application\Shared\ProcessEvent;
use App\Application\Shared\ProcessId;

final class RoomLocked implements ProcessEvent
{
    private ProcessId $processId;
    private RoomLockId $roomLockId;

    public function __construct(ProcessId $processId, RoomLockId $roomLockId)
    {
        $this->processId = $processId;
        $this->roomLockId = $roomLockId;
    }

    public function getProcessId(): ProcessId
    {
        return $this->processId;
    }

    public function getRoomLockId(): RoomLockId
    {
        return $this->roomLockId;
    }
}
