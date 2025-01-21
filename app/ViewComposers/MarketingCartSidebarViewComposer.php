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
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Add cart data to all sales pages
     */
    public function compose(View $view): void
    {
        $cartArray = $this->cartService->toArray();
        $cartJson = ResponseService::cart($cartArray)
            ->respond()
            ->getContent();

        $view->with(['cartData' => $cartJson ]);
    }
}
