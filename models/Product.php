<?php

namespace dm\models;

/**
 * Class Product
 * @package dm\models
 */
class Product implements ProductInterface
{
    /**
     * Название продукта
     * @var string
     */
    private $_name;

    /**
     * Цена продукта
     * @var int
     */
    private $_price;

    /**
     * Количество экземпляров продукта
     * @var int
     */
    private $_amount = 0;

    /**
     * Значение скидки, которая применена к продукту
     * @var int
     */
    private $_discountValue = 0;

    /**
     * Количество экземпляров продукта, на которые действует скидка
     * @var int
     */
    private $_discountAmount = 0;

    /**
     * Конструктор продукта инициализирует название и цену
     * @param $name
     * @param $price
     */
    public function __construct($name, $price)
    {
        $this->_name = $name;
        $this->_price = $price;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @inheritdoc
     */
    public function getPrice()
    {
        return $this->_price;
    }

    /**
     * @inheritdoc
     */
    public function getAmount()
    {
        return $this->_amount;
    }

    /**
     * @inheritdoc
     */
    public function setAmount($amount)
    {
        $this->_amount = $amount;
    }

    /**
     * @inheritdoc
     */
    public function getDiscountValue()
    {
        return $this->_discountValue;
    }

    /**
     * @inheritdoc
     */
    public function setDiscountValue($discountValue)
    {
        $this->_discountValue = $discountValue;
    }

    /**
     * @inheritdoc
     */
    public function getDiscountAmount()
    {
        return $this->_discountAmount;
    }

    /**
     * @inheritdoc
     */
    public function setDiscountAmount($discountAmount)
    {
        $this->_discountAmount = $discountAmount;
    }
}