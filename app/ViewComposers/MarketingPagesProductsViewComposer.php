<?php

namespace App\ViewComposers;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Railroad\Ecommerce\Repositories\ProductRepository;
use Railroad\Ecommerce\Services\CartService;
use Railroad\Ecommerce\Services\ResponseService;

class MarketingPagesProductsViewComposer
{
    private ProductRepository $productRepository;
    private static $viewDataCache = null;

    /**
     * MarketingPagesProductsViewComposer constructor.
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Add cart data to all sales pages
     */
    public function compose(View $view): void
    {
        if (!is_null(self::$viewDataCache)) {
            $view->with(self::$viewDataCache);
            return;
        }

        $products = $this->productRepository->all();

        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        $productModel = Product::query()->select(['sku', 'price', 'discounted_price'])->where('sku', '!=', '')->where('sku', 'not like', '%products%')->get();
        $productPrices = $productModel->mapWithKeys(function ($item) {
            return [$item['sku'] => $item];
        });

        self::$viewDataCache = ['products' => $products, 'productPrices' => $productPrices];

        $view->with(self::$viewDataCache);
    }
}
