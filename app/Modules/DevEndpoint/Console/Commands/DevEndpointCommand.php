<?php

namespace App\Modules\DevEndpoint\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Services\ShopifyAPIService;

//use Railroad\Railcontent\Enums\RecommenderSection;
//use Railroad\Railcontent\Services\RecommendationService;

class DevEndpointCommand extends Command
{
    protected $signature = 'playground';
    protected $description = "Do what you want it's your playground";


    public function handle(
        ShopifyAPIService $shopifyAPIService,
        //RecommendationService $recommenderService,
    ) {
        $configValue1 = config('devendpoint.config1');
        $this->info("hello people $configValue1");
        $this->info('goodbye people');

    }
}
