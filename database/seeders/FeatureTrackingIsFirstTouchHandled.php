<?php

namespace Database\Seeders;

use App\Modules\FeatureFlagging\Models\Tracking;
use Illuminate\Database\Seeder;

class FeatureTrackingIsFirstTouchHandled extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tracking::query()->update(['is_first_touch_handled' => true]);
    }
}
