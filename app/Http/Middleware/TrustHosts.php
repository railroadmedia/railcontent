<?php

namespace App\Http\Middleware;

use App\Modules\Brand\Enums\Brand;
use Illuminate\Http\Middleware\TrustHosts as Middleware;

class TrustHosts extends Middleware
{
    /**
     * Get the host patterns that should be trusted.
     *
     * @return array
     */
    public function hosts()
    {
        return $this->allBrandSubdomainsOfApplicationUrl();
    }

    /**
     * Get the subdomain regex for the application URL, for each brand
     *
     * @return array
     */
    protected function allBrandSubdomainsOfApplicationUrl(): array
    {
        $brands = array_column(Brand::cases(), 'value');

        // grab the APP_URL setting
        $host = parse_url($this->app['config']->get('app.url'), PHP_URL_HOST);
        // and explode it into the different parts, so we can identify the brand portion
        $hostParts = explode('.', $host);
        $brandIndex = count($hostParts) - 2;

        // replace the brand part with each brand and build the list of trusted hosts
        return array_map(function ($brand) use ($hostParts, $brandIndex) {
            $hostParts[$brandIndex] = $brand;
            $brandUrl =  implode('.', $hostParts);
            // replicate the regex from TrustHosts' allSubdomainsOfApplicationUrl
            return '^(.+\.)?'.preg_quote($brandUrl).'$';
        }, $brands);
    }
}
