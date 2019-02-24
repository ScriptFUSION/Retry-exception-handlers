<?php declare(strict_types=1);

namespace ScriptFUSION\Retry\ExceptionHandler;

use ScriptFUSION\Retry\ExceptionHandler\Sequence\PowersOfTwoSequence;

/**
 * Sleeps for an exponentially increasing series of delays.
 */
class ExponentialBackoffExceptionHandler extends MicroSleepExceptionHandler
{
    const DEFAULT_COEFFICIENT = 102000;

    private $microTimeCoefficient;

    public function __construct($microTimeCoefficient = self::DEFAULT_COEFFICIENT)
    {
        parent::__construct($this->generateSequence(
            $this->microTimeCoefficient = $microTimeCoefficient | 0
        ));
    }

    private function generateSequence($coefficient): \Generator
    {
        foreach (new PowersOfTwoSequence as $base) {
            yield $base * $coefficient;
        }
    }
}
