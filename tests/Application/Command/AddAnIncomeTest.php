<?php

declare(strict_types=1);

namespace Campings\Tests\Application\Command;

use PHPUnit\Framework\TestCase;
use Campings\Domain\Event\IncomeCreated;
use Campings\Domain\ValueObject\IncomeId;
use Campings\Infrastructure\Stub\Contract\EventBus;
use Campings\Application\Command\AddAnIncome\Command;
use Campings\Application\Command\AddAnIncome\CommandHandler;
use Campings\Infrastructure\Stub\Repository\IncomeRepository;

final class AddAnIncomeTest extends TestCase
{
    private CommandHandler $commandHandler;

    private const string EXPECTED_INCOME_ID = 'expected-income-id';

    protected function setUp(): void
    {
        $this->commandHandler = new CommandHandler(
            new IncomeRepository(),
            new EventBus(),
        );
    }

    protected function tearDown(): void
    {
        EventBus::reset();
        IncomeRepository::reset();
    }

    public function testAnIncomeShouldBeSaved(): void
    {
        $command = new Command(
            'user-id',
            '2023-10-01',
            'Camping fees',
            '100.00',
        )    ;


        IncomeRepository::reset();

        $incomeId = $this->commandHandler->__invoke($command);

        $this->assertEquals($incomeId, self::EXPECTED_INCOME_ID);

        $this->assertTrue(IncomeRepository::shouldBeSaved(IncomeId::fromString($incomeId)));
    }

    public function testAnIncomeShouldEmitAnIncomeCreatedEvent(): void
    {
        $command = new Command(
            'user-id',
            '2023-10-01',
            'Camping fees',
            '100.00',
        );


        IncomeRepository::reset();

        $incomeId = $this->commandHandler->__invoke($command);

        $this->assertTrue(EventBus::shouldBeDispatched(
            new IncomeCreated(
                IncomeId::fromString($incomeId),
                'user-id',
                '2023-10-01',
                'Camping fees',
                '100.00'
            )
        ));
    }
}
