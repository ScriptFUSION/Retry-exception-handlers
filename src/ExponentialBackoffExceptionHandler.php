<?php
declare(strict_types=1);

namespace ScriptFUSION\Retry\ExceptionHandler;

use ScriptFUSION\Retry\ExceptionHandler\Sequence\PowersOfTwoSequence;

/**
 * Sleeps for an exponentially increasing series of delays.
 *
 * e.g. 102ms, 204ms, 408ms, 816ms, 1.632s...
 */
class ExponentialBackoffExceptionHandler extends MicroSleepExceptionHandler
{
    public const DEFAULT_COEFFICIENT = 102000;

    public function __construct(private readonly int $microTimeCoefficient = self::DEFAULT_COEFFICIENT)
    {
        parent::__construct($this->generateSequence($this->microTimeCoefficient));
    }

    private function generateSequence(int $coefficient): \Generator
    {
        foreach (new PowersOfTwoSequence as $base) {
            yield $base * $coefficient;
        }
    }
}
