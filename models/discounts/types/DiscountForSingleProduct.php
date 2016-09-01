<?php

namespace dm\models\discounts\types;

use dm\models\discounts\Discount;
use dm\models\ProductInterface;

/**
 * Class DiscountForSingleProduct
 * @package dm\models\discounts\types
 */
class DiscountForSingleProduct extends Discount
{
    /**
     * Массив продуктов, от которых зависит действие скидки
     * @var array
     */
    private $_dependencies = [];

    /**
     * @inheritdoc
     */
    public function isApplicable()
    {
        $isProductExists = false;

        /**
         * Проверяем все продукты, участвующие в скидке
         * @var ProductInterface $product
         */
        foreach ($this->_productSet as $product) {

            // Ищем, есть ли добавленные продукты, не участвующие в других скидках
            if ($product->getAmount() > 0 && $product->getDiscountAmount() == 0) {
                $isProductExists = true;
            }
        }

        // Если нет продуктов, которые не участвуют в других скидках, то скидка не действует
        if (!$isProductExists)
            return false;

        /**
         * Проверяем продукты, от которых зависит применение скидки
         * @var ProductInterface $product
         */
        foreach ($this->_dependencies as $product) {

            // Если нет хотя бы одного зависимого продукта, то скидка не действует
            if ($product->getAmount() == 0) {
                return false;
            }
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function getAmountForProduct(ProductInterface $product = null)
    {
        // Количество применений скидки соответствует количеству единиц продукта
        return $product->getAmount();
    }

    /**
     * Устанавливает массив продуктов, от которых зависит действие скидки
     * @param array $dependencies
     * @return void
     */
    public function setDependencies($dependencies)
    {
        $this->_dependencies = $dependencies;
    }
}