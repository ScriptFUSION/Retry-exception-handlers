<?php
declare(strict_types=1);

namespace ScriptFUSION\Retry\ExceptionHandler;

use Amp\Delayed;

/**
 * Delays the current asynchronous execution context for a series of millisecond delays on each invocation.
 */
class AsyncMilliSleepExceptionHandler
{
    private $delays;

    public function __construct(\Iterator $delays)
    {
        $this->delays = $delays;
    }

    public function __invoke()
    {
        // TODO: Iterator validation. i.e. What happens when the iterator is no longer valid?
        $delay = $this->delays->current();

        $this->delays->next();

        return new Delayed($delay);
    }
}
