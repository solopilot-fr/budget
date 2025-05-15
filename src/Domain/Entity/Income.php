<?php

declare(strict_types=1);

namespace Campings\Domain\Entity;

use Campings\Domain\Event\IncomeCreated;
use Campings\Domain\ValueObject\IncomeId;

final class Income
{
    private IncomeId $incomeId;

    /**
     * @var object[]
     */
    private array $events = [];

    public static function create(
        IncomeId $incomeId,
        string $userId,
        string $date,
        string $description,
        string $amount
    ): self {
        $income = new self();
        $income->incomeId = $incomeId;

        $income->events[] = new IncomeCreated(
            $incomeId,
            $userId,
            $date,
            $description,
            $amount
        );

        return $income;
    }

    public function getReference(): IncomeId
    {
        return $this->incomeId;
    }

    /**
     * @return object[]
     */
    public function pullEvents(): array
    {
        $events = $this->events;
        $this->events = [];
        return $events;
    }
}
