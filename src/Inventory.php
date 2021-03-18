<?php


namespace App;


class Inventory
{
    // Representing a central database
    public static $skus = [
        'A' => [
            'price' => 50,
            'quantity' => 100,
            'special' => ['count' => 3, 'total' => 130]
        ],
        'B' => [
            'price' => 30,
            'quantity' => 100,
            'special' => ['count' => 2, 'total' => 45]
        ],
        'C' => [
            'price' => 50,
            'quantity' => 100,
            'special' => []
        ],
        'D' => [
            'price' => 50,
            'quantity' => 100,
            'special' => []
        ],
    ];

    /**
     * Fetch a sku item from the store
     *
     * @param string $sku
     * @return array
     */
    public static function getSku(string $sku): array
    {
        return self::$skus[$sku] ?? [];
    }

    /**
     * Check the stock for a given sku
     *
     * @param string $sku
     * @return bool
     */
    public static function checkAvailable(string $sku): bool
    {
        return array_key_exists($sku, self::$skus) && self::$skus[$sku]['quantity'] != 0;
    }
}