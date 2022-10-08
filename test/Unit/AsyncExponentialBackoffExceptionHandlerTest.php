<?php
declare(strict_types=1);

namespace ScriptFUSIONTest\Retry\ExceptionHandler\Unit;

use PHPUnit\Framework\TestCase;
use ScriptFUSION\Retry\ExceptionHandler\AsyncExponentialBackoffExceptionHandler;
use function Amp\async;

/**
 * @see AsyncExponentialBackoffExceptionHandler
 */
final class AsyncExponentialBackoffExceptionHandlerTest extends TestCase
{
    public function test(): void
    {
        $handler = new AsyncExponentialBackoffExceptionHandler;

        $start = microtime(true);

        async(static function () use ($handler): void {
            for ($counter = 0; $counter < 4; ++$counter) {
                $handler();
            }
        })->await();

        self::assertGreaterThan($start + 1.499, microtime(true));
    }
}
