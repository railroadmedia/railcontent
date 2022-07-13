<?php

namespace App\Modules\Brand\Middleware;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Brand\Services\BrandService;
use Closure;
use Illuminate\Http\Request;

use function user;

class SetLastUsedBrand
{
    private BrandService $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    /**
     * NOTE: this must be set to run AFTER all auth middleware.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // web requests
        if (!empty(user()) && in_array($request->segment(1), config('brands'))) {
            $this->brandService->setLastUsedBrand(user(), Brand::from($request->segment(1)));
        }

        // API requests will have the brand in the params
        if (!empty(user()) &&
            !empty($request->get('brand')) &&
            in_array($request->get('brand'), config('brands'))) {
            $this->brandService->setLastUsedBrand(user(), Brand::from($request->get('brand')));
        }

        if (!empty(user())) {
            $brand = BrandService::getLastUsedBrand(user());

            // set railforums brand and DB connection
            $railforumsConnectionName = config('railforums.brand_database_connection_names')[$brand];
            \Railroad\Railforums\Services\ConfigService::$databaseConnectionName = $railforumsConnectionName;
            config()->set('railforums.database_connection', $railforumsConnectionName);
            config()->set('railforums.database_connection_name', $railforumsConnectionName);
            config()->set('railforums.brand', $brand);
            config()->set('railforums.jump_to_post_url_prefix', $brand . '/forums/jump-to-post/');
            config()->set('railforums.jump_to_thread_url_prefix', $brand . '/forums/jump-to-thread/');
            config()->set('railforums.forums_index_page_url', $brand . '/forums');

            config()->set('railcontent.brand', $brand);

            // set railchat config to be brand specific
            foreach (config('railchat.' . $brand, []) as $configKey => $configValue) {
                config()->set('railchat.' . $configKey, $configValue);
            }
        }

        return $next($request);
    }
}
