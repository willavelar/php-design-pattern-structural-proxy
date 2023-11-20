<?php

use DesignPattern\Right\DiscountCalculator;
use DesignPattern\Right\Budget;
use DesignPattern\Right\DiscountCalculatorProxy;

require "vendor/autoload.php";

$discount = new DiscountCalculator();

$budget1 =  new Budget();
$budget1->value = 100;
$budget1->items = 10;

$budget2 =  new Budget();
$budget2->value = 1000;
$budget2->items = 1;

$discountProxy = new DiscountCalculatorProxy($discount);

echo "Value 1 : ".$budget1->value . PHP_EOL;
echo "Discount : ".$discountProxy->calc($budget1) . PHP_EOL;
echo PHP_EOL;
echo "Value 2 : ".$budget2->value . PHP_EOL;
echo "Discount : ".$discountProxy->calc($budget2) . PHP_EOL;
