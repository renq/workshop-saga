<?php

declare(strict_types=1);

namespace App\Tests\Unit\Reservation;

use App\Reservation\Command\BookRoom;
use App\Reservation\Event\ReservationRequested;
use App\Reservation\Event\RoomId;
use App\Reservation\Event\UserId;
use App\Reservation\ReservationProcess;
use App\Reservation\ReservationState;
use App\Shared\Period;
use App\Shared\ProcessId;
use App\Shared\ProcessResult;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

final class ReservationProcessTest extends TestCase
{
    /** @test */
    public function new_reservation_request_should_generate_book_availability_command(): void
    {
        // Arrange
        $reservationProcess = new ReservationProcess();

        $userId = new UserId('joe@example.com');
        $roomId = new RoomId('GBC/A/6/TonyHsieh');
        $reservationPeriod = new Period(
            new DateTimeImmutable('2020-06-01 13:00:00'),
            new DateTimeImmutable('2020-06-01 14:00:00')
        );
        $processId = new ProcessId(69);

        $incomingEvent = new ReservationRequested($userId, $roomId, $reservationPeriod);
        $initialState = new ReservationState($processId);

        $expectedState = new ReservationState($processId);
        $expectedCommand = new BookRoom($roomId, $reservationPeriod);

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
