<?php

namespace dm\models\discounts;

use dm\models\ProductInterface;

/**
 * Interface DiscountInterface
 * @package dm\models\discounts
 */
interface DiscountInterface
{
    /**
     * Возвращает массив продуктов, на которые действует скидка
     * @return array
     */
    public function getProductSet();

    /**
     * Устанавливает массив продуктов, на которые действует скидка
     * @param array $productSet
     * @return void
     */
    public function setProductSet($productSet);

    /**
     * Устанавливает значение скидки
     * @param int $value
     * @return void
     */
    public function setValue($value);

    /**
     * Проверяет, можно ли применить скидку
     * @return bool
     */
    public function isApplicable();

    /**
     * Возвращает значение скидки для продукта
     * @param ProductInterface|null $product
     * @return int
     */
    public function getValueForProduct(ProductInterface $product = null);

    /**
     * Возвращает количество применений скидки для продукта
     * @param ProductInterface|null $product
     * @return int
     */
    public function getAmountForProduct(ProductInterface $product = null);
}