<?php
namespace ScriptFUSIONTest\Retry\Unit\Sequence;

use ScriptFUSION\Retry\Sequence\PowersOfTwoSequence;

final class PowersOfTwoSequenceTest extends \PHPUnit_Framework_TestCase
{
    public function testSequence()
    {
        $powers = new \LimitIterator((new PowersOfTwoSequence)->getIterator(), 0, 6);

        self::assertSame([1, 2, 4, 8, 16, 32], iterator_to_array($powers));
    }

    public function testIsFiniteSequence()
    {
        $counter = 0;
        foreach (new \LimitIterator((new PowersOfTwoSequence)->getIterator(), 0, $limit = 100) as $_) {
            ++$counter;
        }

        self::assertLessThan($limit, $counter);
    }
}
