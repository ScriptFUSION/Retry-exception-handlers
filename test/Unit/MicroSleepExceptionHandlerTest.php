<?php declare(strict_types=1);

namespace ScriptFUSIONTest\Retry\Unit\ExceptionHandler;

use PHPUnit\Framework\TestCase;
use ScriptFUSION\Retry\ExceptionHandler\MicroSleepExceptionHandler;

final class MicroSleepExceptionHandlerTest extends TestCase
{
    public function testValue()
    {
        $handler = new MicroSleepExceptionHandler(new \ArrayIterator([1000000]));

        $start = microtime(true);
        $handler();

        self::assertGreaterThan($start + 1, microtime(true));
    }

    public function testSeries()
    {
        $handler = new MicroSleepExceptionHandler(new \ArrayIterator($delays = array_fill(0, $limit = 10, 100000)));

        $start = microtime(true);
        for ($counter = 0; $counter < $limit; ++$counter) {
            $handler();
        }

        self::assertGreaterThan($start + 1, microtime(true));
    }
}
