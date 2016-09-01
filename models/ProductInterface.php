<?php

namespace dm\models;

/**
 * Interface ProductInterface
 * @package dm\models
 */
interface ProductInterface
{
    /**
     * Возвращает название продукта
     * @return int
     */
    public function getName();

    /**
     * Возвращает цену продукта
     * @return int
     */
    public function getPrice();

    /**
     * Возвращает количество экземпляров продутка
     * @return int
     */
    public function getAmount();

    /**
     * Устанавливает количество экземпляров продукта
     * @param int $amount
     * @return void
     */
    public function setAmount($amount);

    /**
     * Возвращает значение скидки, которая применена к продукту
     * @return int
     */
    public function getDiscountValue();

    /**
     * Устанавливает значение скидки, которая применена к продукту
     * @param int $discountValue
     * @return void
     */
    public function setDiscountValue($discountValue);

    /**
     * Возвращает количество экземпляров продукта, на которые действует скидка
     * @return int
     */
    public function getDiscountAmount();

    /**
     * Устанавливает количество экземпляров продукта, на которые действует скидка
     * @param int $discountAmount
     * @return void
     */
    public function setDiscountAmount($discountAmount);
}