<?php

namespace DesignPattern\Right;

class DiscountCalculator
{
    public function calc(Budget $budget) : float
    {
        // API Request
        sleep(1);

        $discountCalc = $budget->value *  0.1;

        (new RedisLog())->save($discountCalc);

        return $discountCalc;
    }
}