<?php

declare(strict_types=1);

namespace Campings\Infrastructure\Stub\Contract;

use Campings\Domain\Contract\EventBusInterface;

final class EventBus implements EventBusInterface
{
    /**
     * @var object[]
     */
    public static array $dispatched = [];

    public function dispatch(object ...$events): void
    {
        foreach ($events as $event) {
            self::$dispatched[serialize($event)] = $event;
        }
    }

    public static function reset(): void
    {
        self::$dispatched = [];
    }

    public static function shouldBeDispatched(object $event): bool
    {
        return in_array(serialize($event), array_keys(self::$dispatched), true);
    }
}
