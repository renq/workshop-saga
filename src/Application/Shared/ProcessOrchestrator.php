<?php

declare(strict_types=1);

namespace App\Application\Shared;

final class ProcessOrchestrator
{
    private StateRepository $stateRepository;
    private CommandBus $commandBus;

    /** @var Process[] */
    private array $handlers;

    /**
     * @param StateRepository $stateRepository
     * @param CommandBus $commandBus
     * @param Process[] $handlers
     */
    public function __construct(StateRepository $stateRepository, CommandBus $commandBus, array $handlers)
    {
        $this->stateRepository = $stateRepository;
        $this->commandBus = $commandBus;
        $this->handlers = $handlers;
    }

    public function handle(ProcessEvent $event): void
    {
        $state = $this->stateRepository->find($event->getProcessId());

        foreach ($this->handlers as $handler) {
            if ($handler->supports($event)) {
                $result = $handler->handle($event, $state);

                $state = $result->getState();
                $this->commandBus->dispatch(...$result->getCommands());
                $this->stateRepository->save($state);
            }
        }
    }
}
