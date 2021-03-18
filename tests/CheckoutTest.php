<?php

namespace Tests;

use App\Checkout;
use PHPUnit\Framework\TestCase;

class CheckoutTest extends TestCase
{
    public function test_scanning_sku_a_returns_total_of_50()
    {
        $checkout = new Checkout();

        $checkout->scan('A');

        $this->assertEquals(50, $checkout->total(), 'Checkout total does not equal expected value of 50');
    }

    public function test_sku_special_price()
    {
        $checkout = new Checkout();

        $checkout->scan('A');
        $checkout->scan('A');
        $checkout->scan('A');

        $this->assertEquals(130, $checkout->total());
    }

    public function test_multiple_sku_prices()
    {
        $checkout = new Checkout();

        $checkout->scan('A');
        $checkout->scan('B');
        $checkout->scan('D');

        $this->assertEquals(95, $checkout->total());
    }

    public function test_sku_special_price_remaining()
    {
        $checkout = new Checkout();

        $checkout->scan('A');
        $checkout->scan('A');
        $checkout->scan('A');
        $checkout->scan('A');

        $this->assertEquals(180, $checkout->total());
    }

    public function test_multiple_sku_special_price()
    {
        $checkout = new Checkout();

        $checkout->scan('A');
        $checkout->scan('A');
        $checkout->scan('A');
        $checkout->scan('B');
        $checkout->scan('B');

        $this->assertEquals(175, $checkout->total());
    }
}
