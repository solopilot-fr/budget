<?php

declare(strict_types=1);

namespace Campings\Application\Command\AddAnIncome;

use Campings\Domain\Contract\EventBusInterface;
use Campings\Domain\Entity\Income;
use Campings\Domain\Repository\IncomeRepositoryInterface;
use Campings\Domain\ValueObject\IncomeId;

final readonly class CommandHandler
{
    public function __construct(
        private IncomeRepositoryInterface $incomeRepository,
        private EventBusInterface $eventBus
    ) {

    }

    public function __invoke(Command $command): string
    {
        $incomeId = 'expected-income-id';

        $income = Income::create(
            IncomeId::fromString($incomeId),
            $command->userId,
            $command->date,
            $command->description,
            $command->amount
        );

        $this->incomeRepository->save($income);

        $this->eventBus->dispatch(...$income->pullEvents());

        return $incomeId;
    }
}
