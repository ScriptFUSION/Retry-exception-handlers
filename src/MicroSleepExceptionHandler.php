<?php
declare(strict_types=1);

namespace ScriptFUSION\Retry\ExceptionHandler;

/**
 * Sleeps for a series of microsecond delays on each invocation.
 */
class MicroSleepExceptionHandler
{
    private $delays;

    public function __construct(\Iterator $delays)
    {
        $this->delays = $delays;
    }

    public function __invoke()
    {
        usleep($this->delays->current());

        $this->delays->next();
    }
}
