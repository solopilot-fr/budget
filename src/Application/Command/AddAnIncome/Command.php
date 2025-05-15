<?php

declare(strict_types=1);

namespace Campings\Application\Command\AddAnIncome;

final readonly class Command
{
    public function __construct(
        public string $userId,
        public string $date,
        public string $description,
        public string $amount,
    ) {
    }
}
