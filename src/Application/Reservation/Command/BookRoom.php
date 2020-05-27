<?php

declare(strict_types=1);

namespace App\Application\Reservation\Command;

use App\Application\Reservation\RoomLockId;
use App\Application\Reservation\UserId;

final class BookRoom
{
    private RoomLockId $roomLockId;
    private UserId $userId;

    public function __construct(RoomLockId $roomLockId, UserId $userId)
    {
        $this->roomLockId = $roomLockId;
        $this->userId = $userId;
    }

    public function getRoomLockId(): RoomLockId
    {
        return $this->roomLockId;
    }

    public function getUserId(): UserId
    {
        return $this->userId;
    }
}
