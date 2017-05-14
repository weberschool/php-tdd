<?php

class FizzBuzz
{
    public function execute($n)
    {
        if ($n % 15 === 0) return 'fizzbuzz';
        if ($n % 3 === 0) return 'fizz';
        if ($n % 5 === 0) return 'buzz';

        return $n;
    }

    public function executeUpTo($n)
    {
        return array_map(function ($i) {
            return $this->execute($i);
        }, range(1, $n));
    }
}
