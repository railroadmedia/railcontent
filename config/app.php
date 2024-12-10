<?php

use Illuminate\Support\Facades\Facade;

return [


    'aliases' => Facade::defaultAliases()->merge([
        'Agent' => Jenssegers\Agent\Facades\Agent::class,
        'FeatureFlag' => App\Modules\FeatureFlagging\Facades\FeatureFlagging::class,
        'Prices' => App\Modules\Brand\helpers\Prices::class,
    ])->toArray(),
    'sanity_api_token' => env('SANITY_API_TOKEN'),

];
