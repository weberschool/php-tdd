<?php

class Sale
{

    const MINIMUM = 20;
    
    private $type;
    private $items = [];

    public function addProduct($name, $total)
    {
        $this->items[] = [$name, $total];
    }

    public function paymentType($type)
    {
        $this->type = $type;
    }

    public function getTotal()
    {
        $total = array_reduce($this->items, function($total, $item) {
            return $total += $item[1];
        }, 0);

        return $this->addTax($total);
    }

    public function canFinish()
    {
        return ! ($this->getTotal() <= self::MINIMUM && $this->isCreditCard());
    }

    public function canFinishAndError()
    {
        return [$this->canFinish(), $this->getError()];
    }

    private function getError()
    {
        if ($this->canFinish() === false) {
            return 'Cartão de Crédito só acima de R$ 20';
        }
    }

    private function addTax($total)
    {
        if ($this->isCreditCard()) {
            $total *= 1.05;
        }
        return $total;
    }

    private function isCreditCard()
    {
        return $this->type === 'creditcard';
    }
}
