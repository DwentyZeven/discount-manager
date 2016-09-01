<?php

namespace dm\dao;

/**
 * Interface ProductRepositoryInterface
 * @package dm\dao
 */
interface ProductRepositoryInterface
{
    /**
     * Возвращает массив всех продуктов
     * @return array
     */
    public function getAllProducts();
}