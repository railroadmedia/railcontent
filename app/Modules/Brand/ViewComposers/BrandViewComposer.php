<?php

namespace App\Modules\Brand\ViewComposers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BrandViewComposer
{
    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     * @return void
     */
    public function compose(View $view): void
    {
        $brand = brand();
        if (empty($brand)) {
            $brand = $this->getBrandFromDomain(request());
        }

        $view->with('user', user());
        $view->with('brand', $brand);
    }


    private function getBrandFromDomain(Request $request): ?string
    {
        if (Str::endsWith(request()->host(), 'musora.com')) {
            //if musora we pass null to use the other brand mechanism
            return null;
        } elseif (Str::endsWith(request()->host(), 'drumeo.com')) {
            return "drumeo";
        } elseif (Str::endsWith(request()->host(), 'pianote.com')) {
            return "pianote";
        } elseif (Str::endsWith(request()->host(), 'guitareo.com')) {
            return "guitareo";
        } elseif (Str::endsWith(request()->host(), 'singeo.com')) {
            return "singeo";
        }
        return null;
    }
}
