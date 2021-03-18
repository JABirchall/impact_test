<?php

namespace App;

class Checkout implements CheckoutInterface
{

    protected $cart = [];

    /**
     * Adds an item to the checkout
     *
     * @todo Implement scan() method.
     *
     * @param $sku string
     */
    public function scan(string $sku): void
    {
        if(Inventory::checkAvailable($sku)) {
            $this->cart[] .= $sku;
        }
    }

    /**
     * Calculates the total price of all items in this checkout
     *
     * @todo Implement total() method.
     *
     * @return int
     */
    public function total(): int
    {
        $total = 0;

        if(empty($this->cart)) {
            return $total;
        }

        foreach(array_count_values($this->cart) as $sku => $count) {
            if(!Inventory::checkAvailable($sku)) {
                // Handle out of stock
                continue;
            }

            $product = Inventory::getSku($sku);

            if(!empty($product['special']) && $count >= $product['special']['count']) {
                $remainder = $count % $product['special']['count'];
                $modifier = floor($count / $product['special']['count']);
                $price = ($product['special']['total'] * $modifier) + ($product['price'] * $remainder);
            } else {
                $price = $product['price'] * $count;
            }

            $total += $price;
        }

        return $total;
    }
}
