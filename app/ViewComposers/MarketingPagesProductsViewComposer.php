<?php

namespace App\ViewComposers;

use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Railroad\Ecommerce\Repositories\ProductRepository;
use Railroad\Ecommerce\Services\CartService;
use Railroad\Ecommerce\Services\ResponseService;

class MarketingPagesProductsViewComposer
{
    private ProductRepository $productRepository;

    /**
     * MarketingPagesProductsViewComposer constructor.
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Add cart data to all sales pages
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (Cache::has('all_ecommerce_product_entities')) {
            $products = Cache::get('all_ecommerce_product_entities');
        } else {
            $products = $this->productRepository->all();
            Cache::set('all_ecommerce_product_entities', $products, 300);
        }

        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        $view->with(['products' => $products]);
    }
}
