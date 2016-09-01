<?php

namespace dm\models\discounts;

use dm\models\ProductInterface;

/**
 * Class DiscountManager
 * @package dm\models\discounts
 */
class DiscountManager
{
    /**
     * Применяет переданные скидки
     * @param array $discounts
     * @return void
     */
    public function applyDiscounts($discounts)
    {
        /**
         * Применяем все активные скидки
         * @var DiscountInterface $discount
         */
        foreach ($discounts as $discount) {

            // Если скидка не может быть применена, то переходим к другой скидке
            if (!$discount->isApplicable()) {
                continue;
            }

            /**
             * Применяем скидку к каждому продукту, на который она действует
             * @var ProductInterface $product
             */
            foreach ($discount->getProductSet() as $product)
            {
                $product->setDiscountValue($discount->getValueForProduct($product));
                $product->setDiscountAmount($discount->getAmountForProduct($product));
            }
        }
    }
}