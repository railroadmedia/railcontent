<?php

namespace App\Http\Controllers\Drumeo;

use DataMappers\Ecommerce\ProductDataMapper;
use Exception;
use Illuminate\Routing\Controller;
use Railroad\Ecommerce\Repositories\ProductRepository;
use Utility\Dependencies;

class DrumshopController extends Controller
{
    /**
     * @var ProductRepository
     */
    private $productRepository;
    private $dependencies;

    /**
     * DrumshopController constructor.
     *
     * @param  ProductRepository  $productRepository
     * @param  Dependencies  $dependencies
     */
    public function __construct(
        ProductRepository $productRepository,
        Dependencies $dependencies
    )
    {
        $this->productRepository = $productRepository;
        $this->dependencies = $dependencies;
    }

    public function index()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return $this->dependencies->view->make('drumshop.shop', ['products' => $products]);
    }

    public function lessons()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return $this->dependencies->view->make('drumshop.lessons', ['products' => $products]);
    }
    public function accessories()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return $this->dependencies->view->make('drumshop.accessories', ['products' => $products]);
    }
    public function clothing()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return $this->dependencies->view->make('drumshop.clothing', ['products' => $products]);
    }
    public function toneControl()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return $this->dependencies->view->make('products.full-page-assets.tone-control-kit', ['products' => $products]);
    }
    public function quietKick()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return $this->dependencies->view->make('products.full-page-assets.quietkick', ['products' => $products]);
    }
    public function eardrums()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return $this->dependencies->view->make('products.full-page-assets.eardrums', ['products' => $products]);
    }
    public function thirtyDayDrummer()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return $this->dependencies->view->make('products.full-page-assets.30-day-drummer', ['products' => $products]);
    }

    public function page($shortName)
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        try {
            return $this->dependencies->view->make('products.pages.' . $shortName, ['products' => $products]);
        } catch(Exception $e) {
            return redirect()->to('/');
        }

    }
}
