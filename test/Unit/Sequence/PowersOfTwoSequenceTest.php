<?php
declare(strict_types=1);

namespace ScriptFUSIONTest\Retry\Unit\ExceptionHandler\Sequence;

use PHPUnit\Framework\TestCase;
use ScriptFUSION\Retry\ExceptionHandler\Sequence\PowersOfTwoSequence;

/**
 * @see PowersOfTwoSequence
 */
final class PowersOfTwoSequenceTest extends TestCase
{
    /**
     * Tests that the iterator yields the expected sequence values.
     */
    public function testSequence()
    {
        $powers = new \LimitIterator((new PowersOfTwoSequence)->getIterator(), 0, 6);

        self::assertSame([1, 2, 4, 8, 16, 32], iterator_to_array($powers));
    }

    /**
     * Tests that the iterator will not yield values forever.
     */
    public function testIsFiniteSequence()
    {
        $counter = 0;
        foreach (new \LimitIterator((new PowersOfTwoSequence)->getIterator(), 0, $limit = 100) as $_) {
            ++$counter;
        }

        self::assertLessThan($limit, $counter);
    }
}
