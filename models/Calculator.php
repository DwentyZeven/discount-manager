<?php

namespace dm\models;

/**
 * Class Calculator
 * @package dm\models
 */
class Calculator
{
    /**
     * Вычисляет и возвращает итоговую сумму заказа
     * @param OrderInterface $order
     * @return int
     */
    public function calculateTotalPrice(OrderInterface $order)
    {
        $totalPrice = 0;

        /** @var ProductInterface $product */
        foreach ($order->getProducts() as $product) {
            $totalPrice += $this->_calculateProductPrice(
                $product->getPrice(),
                $product->getAmount(),
                $product->getDiscountValue(),
                $product->getDiscountAmount()
            );
        }

        return $totalPrice;
    }

    /**
     * Вычисляет и возврващает цену продукта с учетом его количества и скидки
     * @param int $price
     * @param int $amount
     * @param int $discountValue
     * @param int $discountAmount
     * @return int
     */
    private function _calculateProductPrice($price, $amount, $discountValue, $discountAmount)
    {
        $priceWithDiscount = $price * (1 - $discountValue / 100) * $discountAmount;
        $priceWithoutDiscount = $price * ($amount - $discountAmount);
        $productPrice = $priceWithDiscount + $priceWithoutDiscount;

        return $productPrice;
    }
}