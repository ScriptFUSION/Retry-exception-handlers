<?php
namespace ScriptFUSIONTest\Retry\Unit\ErrorHandler;

use ScriptFUSION\Retry\ErrorHandler\MicroSleepErrorHandler;

final class MicroSleepErrorHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function testValue()
    {
        $handler = new MicroSleepErrorHandler(new \ArrayIterator([1000000]));

        $start = microtime(true);
        $handler();

        self::assertGreaterThan($start + 1, microtime(true));
    }

    public function testSeries()
    {
        $handler = new MicroSleepErrorHandler(new \ArrayIterator($delays = array_fill(0, $limit = 10, 100000)));

        $start = microtime(true);
        for ($counter = 0; $counter < $limit; ++$counter) {
            $handler();
        }

        self::assertGreaterThan($start + 1, microtime(true));
    }
}
