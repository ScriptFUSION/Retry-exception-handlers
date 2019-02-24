<?php
declare(strict_types=1);

namespace ScriptFUSIONTest\Retry\ExceptionHandler\Unit;

use PHPUnit\Framework\TestCase;
use ScriptFUSION\Retry\ExceptionHandler\AsyncMilliSleepExceptionHandler;

/**
 * @see AsyncMilliSleepExceptionHandler
 */
final class AsyncMilliSleepExceptionHandlerTest extends TestCase
{
    public function testValue()
    {
        $handler = new AsyncMilliSleepExceptionHandler(new \ArrayIterator([1000]));

        $start = microtime(true);
        \Amp\Promise\wait($handler());

        self::assertGreaterThan($start + 1, microtime(true));
    }

    public function testSeries()
    {
        $handler = new AsyncMilliSleepExceptionHandler(
            new \ArrayIterator($delays = array_fill(0, $limit = 10, 100))
        );

        $start = microtime(true);

        \Amp\Loop::run(static function () use ($handler, $limit): \Generator {
            for ($counter = 0; $counter < $limit; ++$counter) {
                yield $handler();
            }
        });

        self::assertGreaterThan($start + 1, microtime(true));
    }
}
