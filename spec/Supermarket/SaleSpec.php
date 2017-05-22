<?php

namespace spec\Supermarket;

use Supermarket\{Sale, Product};
use Supermarket\Finance\{Real, Money, CreditCard};

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
        $paymentWithMoney = new Money(new Real(50));

        // scenario
        $this->addProduct(new Product('redbull', new Real(40)));
        $this->addProduct(new Product('leite', new Real(10)));
        $this->setPayment($paymentWithMoney);

        // asserts
        $this->getTotal()->shouldBeLike(new Real(50));
        $this->getPayment()->shouldBeLike($paymentWithMoney);
    }

    function it_payments_with_50_reais_in_creditcard() 
    {
        $paymentWithCreditCard = new CreditCard(new Real(50));

        // scenario
        $this->addProduct(new Product('redbull', new Real(40)));
        $this->addProduct(new Product('leite', new Real(10)));
        $this->setPayment($paymentWithCreditCard);

        // asserts
        $this->getTotal()->shouldBeLike(new Real(52.5));
        $this->getPayment()->shouldBeLike($paymentWithCreditCard);
    }
}
