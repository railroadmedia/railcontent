<?php

namespace App\Modules\Brand\Middleware;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Brand\Services\BrandService;
use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Railroad\Railtracker\Services\ConfigService;

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

        // check the domain, all brand domains should always have the brand set to that domain regardless of the user
        // or cookie values
        if (Str::endsWith(request()->getHost(), 'drumeo.com')) {
            $brand = 'drumeo';
        } elseif (Str::endsWith(request()->getHost(), 'pianote.com')) {
            $brand = 'pianote';
        } elseif (Str::endsWith(request()->getHost(), 'guitareo.com')) {
            $brand = 'guitareo';
        } elseif (Str::endsWith(request()->getHost(), 'singeo.com')) {
            $brand = 'singeo';
        }

        if (empty($brand) && !empty(user())) {
            $brand = BrandService::getLastUsedBrand(user());
        }

        if (!empty($brand)) {
            if (!empty(user())) {
                $this->brandService->setLastUsedBrand(user(), Brand::from($brand));
            }

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
            config()->set('points.brand', $brand);
            config()->set('railnotifications.brand', $brand);
            config()->set('lead-tracker.brand', $brand);
            config()->set('customer-io.brand', $brand);

            config()->set('event-data-synchronizer.customer_io_brand_activity_event', $brand);
            config()->set('event-data-synchronizer.brand', $brand);

            // set railchat config to be brand specific
            foreach (config('railchat.' . $brand, []) as $configKey => $configValue) {
                config()->set('railchat.' . $configKey, $configValue);
            }

            // set railtracker brand and DB connection
            $railtrackerConnectionName = config('railtracker.brand_database_connection_names')[$brand];
            ConfigService::$databaseConnectionName = $railtrackerConnectionName;
            config()->set('railtracker.database_connection', $railtrackerConnectionName);
            config()->set('railtracker.database_connection_name', $railtrackerConnectionName);
            config()->set('railtracker.brand', $brand);
        }

        return $next($request);
    }
}
