<?php
namespace ScriptFUSION\Retry\ErrorHandler;

/**
 * Sleeps for a series of microsecond delays for each invocation.
 */
class MicroSleepErrorHandler
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
