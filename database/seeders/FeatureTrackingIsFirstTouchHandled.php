<?php

namespace Database\Seeders;

use App\Modules\FeatureFlagging\Models\Tracking;
use Illuminate\Database\Seeder;

class FeatureTrackingIsFirstTouchHandled extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tracking::query()->update(['is_first_touch_handled' => true]);
    }
}
