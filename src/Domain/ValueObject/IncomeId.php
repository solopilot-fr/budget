<?php

declare(strict_types=1);

namespace Campings\Domain\ValueObject;

final readonly class IncomeId
{
    private function __construct(
        private string $incomeId
    ) {
        if ($this->incomeId === '' || $this->incomeId === '0') {
            throw new \InvalidArgumentException('Income ID cannot be empty.');
        }
    }

    public static function fromString(string $incomeId): self
    {
        return new self($incomeId);
    }

    public function getValue(): string
    {
        return $this->incomeId;
    }
}
