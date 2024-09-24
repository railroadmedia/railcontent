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
        return $this->generateBrandDomainsAndSubdomains();
    }

    /**
     * Generate domains and subdomains for each brand's application URL.
     *
     * The underlying system first checks for the request's host to be in the array of hosts,
     * and then does a preg_match on the regex pattern; so for optimal performance, we'll supply both.
     *
     * @return array
     */
    protected function generateBrandDomainsAndSubdomains(): array
    {
        $brands = array_column(Brand::cases(), 'value');

        // grab the APP_URL setting
        $host = parse_url(app()['config']->get('app.url'), PHP_URL_HOST);
        // and explode it into the different parts, so we can identify the brand portion
        $hostParts = explode('.', $host);
        $brandIndex = count($hostParts) - 2;

        $domains = [];

        foreach ($brands as $brand) {
            // build up the url for each brand
            $hostParts[$brandIndex] = $brand;
            $brandUrl =  implode('.', $hostParts);

            // add the normal domain
            $domains[] = $brandUrl;

            // add the subdomain regex, replicating the regex from TrustHosts' allSubdomainsOfApplicationUrl
            $domains[] = '^(.+\.)?'.preg_quote($brandUrl).'$';
        }

        return $domains;
    }
}
