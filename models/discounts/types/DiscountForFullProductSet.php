<?php

namespace dm\models\discounts\types;

use dm\models\discounts\Discount;
use dm\models\ProductInterface;

/**
 * Class DiscountForFullProductSet
 * @package dm\models\discounts\types
 */
class DiscountForFullProductSet extends Discount
{

    /**
     * @inheritdoc
     */
    public function isApplicable()
    {
        /**
         * Проверяем все продукты, участвующие в скидке
         * @var ProductInterface $product
         */
        foreach ($this->_productSet as $product) {

            /**
             * Если хотя бы один продукт не был добавлен или уже участвует
             * в другой скидке, то скидка не действует
             */
            if ($product->getAmount() == 0 || $product->getDiscountAmount() > 0) {
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
        // Количество единиц каждого продукта, на который может действовать скидка
        $productAmounts = [];

        /**
         * Проверяем все продукты, участвующие в скидке
         * @var ProductInterface $discountProduct
         */
        foreach ($this->_productSet as $discountProduct) {
            $productAmounts[] = $discountProduct->getAmount();
        }

        /**
         * Количество применений скидки соответствует минимальному количеству
         * единиц продукта из всех продуктов, участвующих в скидке
         */
        return min($productAmounts);
    }
}