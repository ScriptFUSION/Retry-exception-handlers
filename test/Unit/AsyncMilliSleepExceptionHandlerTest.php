<?php
declare(strict_types=1);

namespace ScriptFUSIONTest\Retry\ExceptionHandler\Unit;

use PHPUnit\Framework\TestCase;
use ScriptFUSION\Retry\ExceptionHandler\AsyncMilliSleepExceptionHandler;
use function Amp\async;

/**
 * @see AsyncMilliSleepExceptionHandler
 */
final class AsyncMilliSleepExceptionHandlerTest extends TestCase
{
    public function testValue(): void
    {
        $handler = new AsyncMilliSleepExceptionHandler(new \ArrayIterator([1000]));

        $start = microtime(true);

        async(fn () => $handler())->await();

        self::assertGreaterThan($start + .999, microtime(true));
    }

    public function testSeries(): void
    {
        $handler = new AsyncMilliSleepExceptionHandler(
            new \ArrayIterator(array_fill(0, $limit = 10, 100))
        );

        $start = microtime(true);

        async(static function () use ($handler, $limit): void {
            for ($counter = 0; $counter < $limit; ++$counter) {
                $handler();
            }
        })->await();

        self::assertGreaterThan($start + .999, microtime(true));
    }
}
