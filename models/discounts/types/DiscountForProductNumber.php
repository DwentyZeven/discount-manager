<?php

namespace dm\models\discounts\types;

use dm\models\discounts\Discount;
use dm\models\ProductInterface;

/**
 * Class DiscountForProductNumber
 * @package dm\models\discounts\types
 */
class DiscountForProductNumber extends Discount
{
    /**
     * Массив продуктов, на которые не действует скидка
     * @var array
     */
    private $_exceptions = [];

    /**
     * Число продуктов, при котором скидка начинает действовать
     * @var int
     */
    private $_productNumber;

    /**
     * @inheritdoc
     */
    public function isApplicable()
    {
        $productNumber = 0;

        /**
         * Проверяем все продукты, участвующие в скидке
         * @var ProductInterface $product
         */
        foreach ($this->_productSet as $product) {

            // Считаем добавленные продукты, не участвующие в скидках и не входящие в исключения
            if ($product->getAmount() > 0 && $product->getDiscountAmount() == 0
                && !in_array($product, $this->_exceptions)) {
                $productNumber++;
            }
        }

        // Если найденно число продуктов меньше необходимого, то скидка не действует
        if ($productNumber < $this->_productNumber) {
            return false;
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function getValueForProduct(ProductInterface $product = null)
    {
        /**
         * Скидка применяется ко всем продуктам, не участвующим в других скидках
         * и не входящим в исключения
         */
        if ($product->getDiscountValue() == 0 && !in_array($product, $this->_exceptions)) {

            // Новое значение скидки для продукта, так как у него не было скидки
            return $this->_value;
        }

        // Значение скидки, которое уже было установлено для продукта
        return $product->getDiscountValue();
    }

    /**
     * @inheritdoc
     */
    public function getAmountForProduct(ProductInterface $product = null)
    {
        /**
         * Скидка применяется ко всем продуктам, не участвующим в других скидках
         * и не входящим в исключения
         */
        if ($product->getDiscountAmount() == 0 && !in_array($product, $this->_exceptions)) {

            // Количество применений скидки соответствует количеству единиц продукта
            return $product->getAmount();
        }

        // Количество применений скидки, которое уже было установлено для продукта
        return $product->getDiscountAmount();
    }

    /**
     * Устанавливает массив продуктов, на которые не действует скидка
     * @param array $exceptions
     * @return void
     */
    public function setExceptions($exceptions)
    {
        $this->_exceptions = $exceptions;
    }

    /**
     * Устанавливает число продуктов, при котором скидка начинает действовать
     * @param int $productNumber
     * @return void
     */
    public function setProductNumber($productNumber)
    {
        $this->_productNumber = $productNumber;
    }
}