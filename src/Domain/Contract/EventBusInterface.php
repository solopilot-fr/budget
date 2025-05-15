<?php

declare(strict_types=1);

namespace Campings\Domain\Contract;

interface EventBusInterface
{
    public function dispatch(object ...$events): void;
}
