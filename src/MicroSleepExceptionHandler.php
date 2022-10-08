<?php
declare(strict_types=1);

namespace ScriptFUSION\Retry\ExceptionHandler;

/**
 * Sleeps for a series of microsecond delays on each invocation.
 */
class MicroSleepExceptionHandler
{
    public function __construct(private readonly \Iterator $delays)
    {
    }

    public function __invoke(): void
    {
        usleep($this->delays->current());

        $this->delays->next();
    }
}
