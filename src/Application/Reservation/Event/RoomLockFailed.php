<?php

declare(strict_types=1);

namespace App\Application\Reservation\Event;

use App\Application\Reservation\RoomLockId;
use App\Application\Shared\ProcessId;

final class RoomLockFailed
{
    private ProcessId $processId;
    private RoomLockId $roomLockId;
}
