<?php
declare(strict_types=1);

namespace ScriptFUSIONTest\Retry\Unit\ExceptionHandler;

use PHPUnit\Framework\TestCase;
use ScriptFUSION\Retry\ExceptionHandler\ExponentialBackoffExceptionHandler;

/**
 * @see ExponentialBackoffExceptionHandler
 */
final class ExponentialBackoffExceptionHandlerTest extends TestCase
{
    public function test(): void
    {
        $handler = new ExponentialBackoffExceptionHandler;

        $start = microtime(true);
        for ($counter = 0; $counter < 4; ++$counter) {
            $handler();
        }

        self::assertGreaterThan($start + 1.5, microtime(true));
    }
}
