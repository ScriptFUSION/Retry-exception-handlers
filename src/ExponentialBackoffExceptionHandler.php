<?php
namespace ScriptFUSION\Retry\ExceptionHandler;

use ScriptFUSION\Retry\ExceptionHandler\Sequence\PowersOfTwoSequence;

/**
 * Sleeps for an exponentially increasing series of delays.
 */
class ExponentialBackoffExceptionHandler extends MicroSleepExceptionHandler
{
    private $microTimeCoefficient;

    public function __construct($microTimeCoefficient = 102000)
    {
        parent::__construct($this->generateSequence(
            $this->microTimeCoefficient = $microTimeCoefficient|0
        ));
    }

    private function generateSequence($coefficient)
    {
        foreach (new PowersOfTwoSequence as $base) {
            yield $base * $coefficient;
        }
    }
}