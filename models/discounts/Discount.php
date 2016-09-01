<?php

namespace dm\models\discounts;

use dm\models\ProductInterface;

/**
 * Class Discount
 * @package dm\models\discounts
 */
abstract class Discount implements DiscountInterface
{
    /**
     * Массив продуктов, на которые действует скидка
     * @var array
     */
    protected $_productSet = [];

    /**
     * Значение скидки
     * @var int
     */
    protected $_value;

    /**
     * @inheritdoc
     */
    public function getProductSet()
    {
        return $this->_productSet;
    }

    /**
     * @inheritdoc
     */
    public function setProductSet($productSet)
    {
        $this->_productSet = $productSet;
    }

    /**
     * @inheritdoc
     */
    public function setValue($value)
    {
        $this->_value = $value;
    }

    /**
     * @inheritdoc
     */
    public function getValueForProduct(ProductInterface $product = null)
    {
        return $this->_value;
    }
}