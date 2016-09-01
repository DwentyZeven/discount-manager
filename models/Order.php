<?php

namespace dm\models;

/**
 * Class Order
 * @package dm\models
 */
class Order implements OrderInterface
{
    /**
     * Массив продуктов заказа
     * @var array
     */
    private $_products = [];

    /**
     * @inheritdoc
     */
    public function getProducts()
    {
        return $this->_products;
    }

    /**
     * @inheritdoc
     */
    public function push(ProductInterface $product, $amount = 1)
    {
        $product->setAmount($product->getAmount() + $amount);
        $key = array_search($product, $this->_products, true);

        if ($key === false) {
            $this->_products[] = $product;
        }
    }
}