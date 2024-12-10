<?php

use Illuminate\Support\Facades\Facade;

return [


    'aliases' => Facade::defaultAliases()->merge([
        'Agent' => Jenssegers\Agent\Facades\Agent::class,
        'FeatureFlag' => App\Modules\FeatureFlagging\Facades\FeatureFlagging::class,
        'Prices' => App\Modules\Brand\helpers\Prices::class,
    ])->toArray(),
    'sanity_project_id' => env('SANITY_CMS_PROJECT_ID', '4032r8py'),
    'sanity_api_token' => env('SANITY_API_TOKEN'),
    'sanity_dataset' => env('SANITY_DATASET', 'development'),
    'mcs_debug' => env('MCS_DEBUG', false)
];
