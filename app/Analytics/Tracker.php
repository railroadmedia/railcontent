<?php

namespace App\Analytics;

use Railroad\Ecommerce\Repositories\ProductRepository;
use Railroad\Railanalytics\Tracker as TrackerBase;

// todo: test/confirm functionality
/**
 * Class Tracker
 *
 * @package App\Analytics
 *
 * @method static string headTop()
 * @method static string headBottom()
 * @method static string bodyTop()
 * @method static string bodyBottom()
 *
 * @method static trackPageView()
 * @method static trackInitiateCheckout(array $products, $step, $currency = 'USD')
 * @method static trackAddPaymentInformation()
 * @method static trackTransaction(array $products, $transactionId, $revenue, $tax, $shipping, $currency = 'USD')
 * @method static string trackLead($value = null, $currency = 'USD')
 * @method static trackRegistration()
 * @method static queue(callable $function)
 */
class Tracker
{
    private static $productCache;

    /**
     * @param $sku
     */
    public static function trackProductImpression($sku)
    {
        $productsBySku = self::products();

        if (!empty($productsBySku[$sku])) {
            $product = $productsBySku[$sku];

            TrackerBase::trackProductImpression(
                $product['id'],
                $product['name'] . ' - ' . $product['sku'],
                $product['type']
            );
        }
    }

    /**
     * @param $sku
     */
    public static function trackProductDetailsImpression($sku)
    {
        $productsBySku = self::products();

        if (!empty($productsBySku[$sku])) {
            $product = $productsBySku[$sku];

            TrackerBase::trackProductDetailsImpression(
                $product['id'],
                $product['name'] . ' - ' . $product['sku'],
                $product['type'],
                $product['price']
            );
        }
    }

    /**
     * @param $sku
     * @param $price
     * @param $quantity
     */
    public static function trackAddToCart($sku, $price, $quantity)
    {
        $productsBySku = self::products();

        if (!empty($productsBySku[$sku])) {
            $product = $productsBySku[$sku];

            TrackerBase::trackAddToCart(
                $product['id'],
                $product['name'] . ' - ' . $product['sku'],
                $product['type'],
                $price,
                $quantity
            );
        }
    }

    /**
     * @param $name
     * @param $arguments
     * @return string
     */
    public static function __callStatic($name, $arguments)
    {
        return call_user_func_array(array(TrackerBase::class, $name), $arguments);
    }

    /**
     * @return array
     */
    private static function products()
    {
        if (empty(self::$productCache)) {
            self::$productCache = cache()->remember(
                'products.all',
                60,
                function () {
                    $productRepository = app(ProductRepository::class);

                    $products = $productRepository->findBy(['brand' => 'drumeo']);

                    $productsMap = [];

                    foreach ($products as $product) {
                        $productsMap[$product->getSku()] = [
                            'id' => $product->getId(),
                            'sku' => $product->getSku(),
                            'name' => $product->getName(),
                            'type' => $product->getType(),
                            'price' => $product->getPrice(),
                        ];
                    }

                    return $productsMap;
                }
            );
        }

        return self::$productCache;
    }
}
