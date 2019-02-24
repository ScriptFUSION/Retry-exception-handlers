<?php
declare(strict_types=1);

namespace ScriptFUSION\Retry\ExceptionHandler;

use Amp\Delayed;

/**
 * Delays for a series of millisecond delays on each invocation.
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
        $delay = $this->delays->current();

        $this->delays->next();

        return new Delayed($delay);
    }
}
