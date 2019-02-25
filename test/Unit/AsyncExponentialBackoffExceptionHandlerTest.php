<?php
declare(strict_types=1);

namespace ScriptFUSIONTest\Retry\ExceptionHandler\Unit;

use PHPUnit\Framework\TestCase;
use ScriptFUSION\Retry\ExceptionHandler\AsyncExponentialBackoffExceptionHandler;

/**
 * @see AsyncExponentialBackoffExceptionHandler
 */
final class AsyncExponentialBackoffExceptionHandlerTest extends TestCase
{
    public function test()
    {
        $handler = new AsyncExponentialBackoffExceptionHandler;

        \Amp\Loop::run(static function () use ($handler): \Generator {
            $start = microtime(true);

            for ($counter = 0; $counter < 4; ++$counter) {
                yield $handler();
            }

            self::assertGreaterThan($start + 1.5, microtime(true));
        });
    }
}
