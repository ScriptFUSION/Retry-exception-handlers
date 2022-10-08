<?php
declare(strict_types=1);

namespace ScriptFUSION\Retry\ExceptionHandler;

use ScriptFUSION\Retry\ExceptionHandler\Sequence\PowersOfTwoSequence;

/**
 * Delays the current asynchronous execution context for an exponentially increasing series of delays.
 *
 * e.g. 102ms, 204ms, 408ms, 816ms, 1.632s...
 */
class AsyncExponentialBackoffExceptionHandler extends AsyncMilliSleepExceptionHandler
{
    public const DEFAULT_COEFFICIENT = 102;

    public function __construct(private readonly int $millisecondCoefficient = self::DEFAULT_COEFFICIENT)
    {
        parent::__construct($this->generateSequence($this->millisecondCoefficient));
    }

    private function generateSequence($coefficient): \Generator
    {
        foreach (new PowersOfTwoSequence as $base) {
            yield $base * $coefficient;
        }
    }
}
