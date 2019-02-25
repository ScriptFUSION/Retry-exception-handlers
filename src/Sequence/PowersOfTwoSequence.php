<?php
declare(strict_types=1);

namespace ScriptFUSION\Retry\ExceptionHandler\Sequence;

/**
 * Represents a sequence of values of the power two.
 *
 * e.g. 1, 2, 4, 8, 16...
 */
final class PowersOfTwoSequence implements \IteratorAggregate
{
    private $power = 0;

    public function getIterator()
    {
        yield 1;

        while (0 < $value = 2 << $this->power++) {
            yield $value;
        }
    }
}
