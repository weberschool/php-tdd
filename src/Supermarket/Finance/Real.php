<?php

namespace Supermarket\Finance;

class Real
{

    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function add(Real $real)
    {
        return new Real($this->getValue() + $real->getValue());
    }

    public function multiply($n)
    {
        return new Real($this->getValue() * $n);
    }

    public function getValue()
    {
        return $this->value;
    }

}