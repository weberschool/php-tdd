<?php

namespace spec;

use FizzBuzz;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FizzBuzzSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(FizzBuzz::class);
    }

    function it_translates_1_for_fizzbuzz() 
    {
        $this->execute(1)->shouldReturn(1);
    }

    function it_translates_2_for_fizzbuzz()
    {
        $this->execute(2)->shouldReturn(2);
    }

    function it_translates_3_for_fizzbuzz()
    {
        $this->execute(3)->shouldReturn('fizz');
    }

    function it_translates_5_for_fizzbuzz()
    {
        $this->execute(5)->shouldReturn('buzz');
    }

    function it_translates_6_for_fizzbuzz()
    {
        $this->execute(6)->shouldReturn('fizz');
    }

    function it_translates_10_for_fizzbuzz()
    {
        $this->execute(10)->shouldReturn('buzz');
    }
    
    function it_translates_15_for_fizzbuzz()
    {
        $this->execute(15)->shouldReturn('fizzbuzz');
    }

    function it_translates_123_for_fizzbuzz()
    {
        $this->execute(123)->shouldReturn('fizz');
    }

    function it_translates_a_sequence_of_numbers_for_fizzbuzz()
    {
        $this->executeUpTo(10)->shouldReturn([1, 2, 'fizz', 4, 'buzz', 'fizz', 7, 8, 'fizz', 'buzz']);
    }
}
