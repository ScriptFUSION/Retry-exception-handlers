<?php
namespace ScriptFUSIONTest\Retry\Unit\ExceptionHandler;

use ScriptFUSION\Retry\ExceptionHandler\ExponentialBackoffExceptionHandler;

final class ExponentialBackoffExceptionHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $handler = new ExponentialBackoffExceptionHandler;

        $start = microtime(true);
        for ($counter = 0; $counter < 4; ++$counter) {
            $handler();
        }

        self::assertGreaterThan($start + 1.5, microtime(true));
    }
}
