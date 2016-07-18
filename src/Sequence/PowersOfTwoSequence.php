<?php
namespace ScriptFUSION\Retry\Sequence;

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
