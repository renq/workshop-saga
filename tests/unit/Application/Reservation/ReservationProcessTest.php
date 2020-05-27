<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\Reservation;

use App\Application\Reservation\Command\BookRoom;
use App\Application\Reservation\Command\LockRoom;
use App\Application\Reservation\Event\ReservationRequested;
use App\Application\Reservation\Event\RoomLocked;
use App\Application\Reservation\ReservationProcess;
use App\Application\Reservation\ReservationState;
use App\Application\Reservation\RoomId;
use App\Application\Reservation\RoomLockId;
use App\Application\Reservation\UserId;
use App\Application\Shared\Period;
use App\Application\Shared\ProcessId;
use App\Application\Shared\ProcessResult;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

final class ReservationProcessTest extends TestCase
{
    private ProcessId $processId;
    private UserId $userId;
    private RoomId $roomId;
    private Period $reservationPeriod;
    private RoomLockId $roomLockId;

    protected function setUp(): void
    {
        $this->processId = new ProcessId(69);
        $this->userId = new UserId('joe@example.com');
        $this->roomId = new RoomId('GBC/A/6/TonyHsieh');
        $this->reservationPeriod = new Period(
            new DateTimeImmutable('2020-06-01 13:00:00'),
            new DateTimeImmutable('2020-06-01 14:00:00')
        );
        $this->roomLockId = new RoomLockId(1234);
    }

    /** @test */
    public function new_reservation_request_should_generate_lock_room_command(): void
    {
        // Arrange
        $reservationProcess = new ReservationProcess();

        $incomingEvent = new ReservationRequested(
            $this->processId,
            $this->userId,
            $this->roomId,
            $this->reservationPeriod
        );
        $initialState = new ReservationState($this->processId);

        $expectedState = new ReservationState($this->processId);
        $expectedState->reservationPeriod = $this->reservationPeriod;
        $expectedState->roomId = $this->roomId;
        $expectedState->userId = $this->userId;

        $expectedCommand = new LockRoom($this->roomId, $this->reservationPeriod);

        // Act
        $result = $reservationProcess->handle($incomingEvent, $initialState);

        // Assert
        self::assertEquals(
            $result,
            new ProcessResult(
                $expectedState,
                [$expectedCommand]
            )
        );
    }

    /** @test */
    public function after_locking_the_room_we_should_try_to_book_the_room_for_the_user(): void
    {
        // Arrange
        $reservationProcess = new ReservationProcess();

        $incomingEvent = new RoomLocked($this->processId, $this->roomLockId);
        $initialState = new ReservationState($this->processId);
        $initialState->reservationPeriod = $this->reservationPeriod;
        $initialState->roomId = $this->roomId;
        $initialState->userId = $this->userId;

        $expectedState = clone $initialState;
        $expectedState->roomLockId = $this->roomLockId;

        $expectedCommand = new BookRoom($this->roomLockId, $this->userId);

        // Act
        $result = $reservationProcess->handle($incomingEvent, $initialState);

        // Assert
        self::assertEquals(
            $result,
            new ProcessResult(
                $expectedState,
                [$expectedCommand]
            )
        );
    }
}
