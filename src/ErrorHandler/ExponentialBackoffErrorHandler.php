<?php
namespace ScriptFUSION\Retry\ErrorHandler;

use ScriptFUSION\Retry\Sequence\PowersOfTwoSequence;

/**
 * Sleeps for an exponentially increasing series of delays.
 */
class ExponentialBackoffErrorHandler extends MicroSleepErrorHandler
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
