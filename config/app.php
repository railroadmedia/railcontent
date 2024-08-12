<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [


    'aliases' => Facade::defaultAliases()->merge([
        'Agent' => Jenssegers\Agent\Facades\Agent::class,
        'FeatureFlag' => App\Modules\FeatureFlagging\Facades\FeatureFlagging::class,
    ])->toArray(),

];
