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
        $total = array_reduce($this->products, function($total, $product) {
            return $total->add($product->getValue());
        }, new Real(0));
 
        return $this->addTax($total);
    }

    public function setPayment(PaymentTypeInterface $payment)
    {
        $this->payment = $payment;
    }

    public function getPayment()
    {
        return $this->payment;
    }

    private function addTax(Real $total)
    {
        $totalWithTax = clone $total;
        
        if ($this->payment instanceof Finance\CreditCard) {
            $totalWithTax = $total->multiply(1.05); // 5%
        }

        return $totalWithTax;
    }
}
