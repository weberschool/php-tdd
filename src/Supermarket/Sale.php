<?php

namespace Supermarket;

use Supermarket\Finance\{PaymentTypeInterface, CrediCard, Real};

class Sale
{

    private $products;

    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }

    public function getTotal()
    {
        $total = new Real(0);

        foreach ($this->products as $product) {
            $total = $total->add($product->getValue());
        }
 
        if ($this->payment instanceof Finance\CreditCard) {
            $total = $total->multiply(1.05); // 5%
        }

        return $total;
    }

    public function setPayment(PaymentTypeInterface $payment)
    {
        $this->payment = $payment;
    }

    public function getPayment()
    {
        return $this->payment;
    }
}
