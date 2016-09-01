<?php

namespace dm\dao;

use dm\models\Product;

/**
 * Class ProductRepository
 * @package dm\dao
 */
class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function getAllProducts()
    {
        return [
            new Product('A', 100),
            new Product('B', 100),
            new Product('C', 100),
            new Product('D', 100),
            new Product('E', 100),
            new Product('F', 100),
            new Product('G', 100),
            new Product('H', 100),
            new Product('I', 100),
            new Product('J', 100),
            new Product('K', 100),
            new Product('L', 100),
            new Product('M', 100)
        ];
    }
}