## Proxy

Proxy is a structural design pattern that lets you provide a substitute or placeholder for another object. A proxy controls access to the original object, allowing you to perform something either before or after the request gets through to the original object.

-----

We need to create a discount calculator, where the calculation makes a request to an external API

### The problem

If we do it this way, we are held hostage by the API if it takes too long

```php
<?php
class Budget 
{
    public float $value;
    public int $items;
}
```
```php
<?php
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
```
```php
<?php
interface Log
{
    public function save(string $info) : void;
}
```
```php
<?php
class RedisLog implements Log
{
    public function save(string $info): void
    {
        // TODO: Implement save() method.
    }
}
```

### The solution

Now, using the Proxy pattern, we can store the value of the original object, not repeating it every time for the API

```php
<?php
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
```

-----

### Installation for test

![PHP Version Support](https://img.shields.io/badge/php-7.4%2B-brightgreen.svg?style=flat-square) ![Composer Version Support](https://img.shields.io/badge/composer-2.2.9%2B-brightgreen.svg?style=flat-square)

```bash
composer install
```

```bash
php wrong/test.php
php right/test.php
```