<?php

declare(strict_types=1);

namespace Campings\Infrastructure\Stub\Repository;

use Campings\Domain\Entity\Income;
use Campings\Domain\Repository\IncomeRepositoryInterface;
use Campings\Domain\ValueObject\IncomeId;

final class IncomeRepository implements IncomeRepositoryInterface
{
    /**
     * @var string[]
     */
    private static array $saved = [];

    public function save(Income $income): void
    {
        self::$saved[] = $income->getReference()->getValue();
    }

    public static function reset(): void
    {
        self::$saved = [];
    }

    public static function shouldBeSaved(IncomeId $incomeId): bool
    {
        return in_array($incomeId->getValue(), self::$saved, true);
    }
}
