<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use Railroad\Ecommerce\Services\CartService;
use Railroad\Ecommerce\Services\ResponseService;

class MarketingCartSidebarViewComposer
{
    /**
     * @var CartService
     */
    private $cartService;

    /**
     * SalesNavComposer constructor.
     *
     * @param CartService $cartService
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Add cart data to all sales pages
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $cartArray = $this->cartService->toArray();
        $cartJson = ResponseService::cart($cartArray)
            ->respond()
            ->getContent();

        $view->with(['cartData' => $cartJson, ]);
    }
}
