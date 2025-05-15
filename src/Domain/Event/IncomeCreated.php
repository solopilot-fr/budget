<?php

declare(strict_types=1);

namespace Campings\Domain\Event;

use Campings\Domain\ValueObject\IncomeId;

final readonly class IncomeCreated
{
    public function __construct(
        public IncomeId $incomeId,
        public string $userId,
        public string $date,
        public string $description,
        public string $amount,
    ) {
    }
}
