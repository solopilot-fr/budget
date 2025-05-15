<?php

declare(strict_types=1);

namespace Campings\Domain\Repository;

use Campings\Domain\Entity\Income;

interface IncomeRepositoryInterface
{
    public function save(Income $income): void;
}
