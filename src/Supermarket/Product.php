<?php

namespace Supermarket;

use Supermarket\Finance\Real;

class Product 
{

    private $name, $value;

    public function __construct($name, Real $value)
    {
        $this->name  = $name;
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}