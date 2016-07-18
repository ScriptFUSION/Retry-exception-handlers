<?php
namespace ScriptFUSIONTest\Retry\Unit\ErrorHandler;

use ScriptFUSION\Retry\ErrorHandler\ExponentialBackoffErrorHandler;

final class ExponentialBackoffErrorHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $handler = new ExponentialBackoffErrorHandler;

        $start = microtime(true);
        for ($counter = 0; $counter < 4; ++$counter) {
            $handler();
        }

        self::assertGreaterThan($start + 1.5, microtime(true));
    }
}
