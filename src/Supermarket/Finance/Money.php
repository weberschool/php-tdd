<?php

namespace Supermarket\Finance;

class Money implements PaymentTypeInterface
{

    private $value;

    public function __construct(Real $valueInReal) 
    {
        $this->value = $valueInReal;
    }

}