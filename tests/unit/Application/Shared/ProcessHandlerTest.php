<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\Shared;

use App\Application\Shared\ProcessId;
use App\Application\Shared\ProcessOrchestrator;
use App\Infrastructure\Shared\InMemoryStateRepository;
use App\Infrastructure\Shared\SimpleCommandBus;
use App\Tests\Kit\Double\DoValidAssertion;
use App\Tests\Kit\Double\SampleProcess;
use App\Tests\Kit\Double\SampleState;
use App\Tests\Kit\Double\UnitTestExecuted;
use PHPUnit\Framework\TestCase;

class ProcessHandlerTest extends TestCase
{
    /** @test */
    public function event_should_be_sent_to_handler_that_supports_it(): void
    {
        // Arrange
        $processId = new ProcessId(666);
        $stateRepository = new InMemoryStateRepository();
        $commandBus = new SimpleCommandBus();
        $testHandler = new SampleProcess();
        $processHandler = new ProcessOrchestrator($stateRepository, $commandBus, [$testHandler]);

        $event = new UnitTestExecuted($processId);

        $expectedDispatchedCommand = new DoValidAssertion();
        $expectedStoredState = new SampleState($event->getProcessId());

        // Act
        $processHandler->handle($event);

        // Assert
        self::assertEquals([$expectedDispatchedCommand], $commandBus->getDispatchedCommands());
        self::assertEquals($expectedStoredState, $stateRepository->find($processId));
    }
}
