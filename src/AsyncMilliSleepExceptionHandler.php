<?php
declare(strict_types=1);

namespace ScriptFUSION\Retry\ExceptionHandler;

use function Amp\delay;

/**
 * Delays the current asynchronous execution context for a series of millisecond delays on each invocation.
 */
class AsyncMilliSleepExceptionHandler
{
    public function __construct(private readonly \Iterator $delays)
    {
    }

    public function __invoke(): void
    {
        // TODO: Iterator validation. i.e. What happens when the iterator is no longer valid?
        $delay = $this->delays->current();

        $this->delays->next();

        delay($delay / 1000);
    }
}
