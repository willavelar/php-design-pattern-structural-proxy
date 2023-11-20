<?php

namespace DesignPattern\Right;

class DiscountCalculatorProxy extends DiscountCalculator
{
    private float $calcProxy = 0;
    private DiscountCalculator $discountCalculator;

    public function __construct(DiscountCalculator $discountCalculator)
    {
        $this->discountCalculator = $discountCalculator;
    }

    public function calc(Budget $budget): float
    {
        if ($this->calcProxy == 0) {
            $this->calcProxy = $this->discountCalculator->calc($budget);
        }

        return $this->calcProxy;
    }
}