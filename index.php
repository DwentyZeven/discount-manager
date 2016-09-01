<?php

use dm\dao\ProductRepository;
use dm\models\Calculator;
use dm\models\discounts\DiscountManager;
use dm\models\discounts\types\DiscountForFullProductSet;
use dm\models\discounts\types\DiscountForProductNumber;
use dm\models\discounts\types\DiscountForSingleProduct;
use dm\models\Order;

require_once 'base.php';

$productRepository = new ProductRepository();
$allProducts = $productRepository->getAllProducts();
list($productA, $productB, $productC, $productD, $productE, $productF, $productG,
    $productH, $productI, $productJ, $productK, $productL, $productM) = $allProducts;


/**
 * Создаем объекты скидок и конфигурируем их связи с продуктами
 */

// Если одновременно выбраны А и B, то их суммарная стоимость уменьшается на 10% (для каждой пары А и B)
$discount1 = new DiscountForFullProductSet();
$discount1->setProductSet([$productA, $productB]);
$discount1->setValue(10);

// Если одновременно выбраны D и E, то их суммарная стоимость уменьшается на 5% (для каждой пары D и E)
$discount2 = new DiscountForFullProductSet();
$discount2->setProductSet([$productD, $productE]);
$discount2->setValue(5);

// Если одновременно выбраны E, F, G, то их суммарная стоимость уменьшается на 5% (для каждой тройки E, F, G)
$discount3 = new DiscountForFullProductSet();
$discount3->setProductSet([$productE, $productF, $productG]);
$discount3->setValue(5);

// Если одновременно выбраны А и один из [K, L, M], то стоимость выбранного продукта уменьшается на 5%
$discount4 = new DiscountForSingleProduct();
$discount4->setProductSet([$productK, $productL, $productM]);
$discount4->setDependencies([$productA]);
$discount4->setValue(5);

// Если пользователь выбрал одновременно 5 продуктов, он получает скидку 20% от суммы заказа (исключаем A и C)
$discount5 = new DiscountForProductNumber();
$discount5->setProductSet($allProducts);
$discount5->setExceptions([$productA, $productC]);
$discount5->setProductNumber(5);
$discount5->setValue(20);

// Если пользователь выбрал одновременно 4 продукта, он получает скидку 10% от суммы заказа (исключаем A и C)
$discount6 = new DiscountForProductNumber();
$discount6->setProductSet($allProducts);
$discount6->setExceptions([$productA, $productC]);
$discount6->setProductNumber(4);
$discount6->setValue(10);

// Если пользователь выбрал одновременно 3 продукта, он получает скидку 5% от суммы заказа (исключаем A и C)
$discount7 = new DiscountForProductNumber();
$discount7->setProductSet($allProducts);
$discount7->setExceptions([$productA, $productC]);
$discount7->setProductNumber(3);
$discount7->setValue(5);

// Формируем заказ
$order = new Order();
$order->push($productA);
$order->push($productB);
$order->push($productC);
$order->push($productD);
$order->push($productE);
$order->push($productF);
$order->push($productG);
$order->push($productH);
$order->push($productI);
$order->push($productJ);
$order->push($productK);
$order->push($productL);
$order->push($productM);

// Добавляем активные скидки в менеджер скидок, применяем скидки
$discountManager = new DiscountManager();
$discountManager->applyDiscounts(
    [$discount1, $discount2, $discount3, $discount4, $discount5, $discount6, $discount7]
);

// Добавляем в калькулятор заказ, производим расчет
$calculator = new Calculator();
$result = $calculator->calculateTotalPrice($order);

// Выводим результат
echo '<h3>Discount Manager</h3>';
echo $result;