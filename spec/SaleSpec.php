<?php

namespace spec;

use Sale;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SaleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Sale::class);
    }

    function it_payments_with_50_reais_in_money()
    {
        $this->addProduct('redbull', 50);
        $this->paymentType('money');
        
        $this->getTotal()->shouldReturn(50);
        $this->canFinishAndError()->shouldReturn([true, null]);
    }

    function it_payments_with_50_reais()
    {
        $this->addProduct('redbull', 50);
        $this->paymentType('money');

        $this->getTotal()->shouldReturn(50);
        $this->canFinishAndError()->shouldReturn([true, null]);
    }

    function it_payments_with_15_reais_in_money()
    {
        $this->addProduct('redbull', 15);
        $this->paymentType('money');
        
        $this->getTotal()->shouldReturn(15);
        $this->canFinishAndError()->shouldReturn([true, null]);
    }

    function it_payments_with_50_reais_in_creditcard_above_limit()
    {
        $this->addProduct('redbull', 50);
        $this->paymentType('creditcard');
        
        $this->getTotal()->shouldReturn(52.5);
        $this->canFinishAndError()->shouldReturn([true, null]);
    }

    function it_payments_with_50_reais_in_creditcard_below_limit()
    {
        $this->addProduct('redbull', 15);
        $this->paymentType('creditcard');
        
        $this->getTotal()->shouldReturn(15.75);
        $this->canFinishAndError()->shouldReturn([false, 'Cartão de Crédito só acima de R$ 20']);
    }

}
