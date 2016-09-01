<?php

namespace dm\models;

/**
 * Interface OrderInterface
 * @package dm\models
 */
interface OrderInterface
{
    /**
     * Возвращает массив продуктов заказа
     * @return array
     */
    public function getProducts();

    /**
     * Добавляет продукт в заказ
     * @param ProductInterface $push
     * @param int $amount
     * @return void
     */
    public function push(ProductInterface $push, $amount);
}