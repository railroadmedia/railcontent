<?php

namespace Database\Seeders;

use App\Modules\FeatureFlagging\Models\Branch;
use App\Modules\FeatureFlagging\Models\Experiment;
use Illuminate\Database\Seeder;
use App\Modules\FeatureFlagging\Models\Feature;
use Carbon\Carbon;

class FeatureSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $features = [
            [
                'name' => 'featureA',
                'description' => 'featureADesc',
                'allow_filter' => 'admin',
                'active_at' => Carbon::now(),
                'userid_list' => "1, 631736"
            ],
            [
                'name' => 'featureB',
                'description' => 'featureBDesc',
                'allow_filter' => 'older_than_3_months',
                'active_at' => Carbon::now()->addDays(5),
            ],
            [
                'name' => 'featureC',
                'description' => 'featureCDesc',
                'allow_filter' => null,
                'active_at' => Carbon::now()->addDays(5),
            ]
        ];


        $experiments = [
            [
                'name' => 'experimentA',
                'default_value' => 'X'
            ],
            [
                'name' => 'experimentB',
                'default_value' => 'Y'
            ],
        ];
        $dbExperiments = [];
        foreach($experiments as $experiment) {
            $dbExperiments[] = Experiment::create($experiment);
        }
        $branches = [
            [
                'name' => 'branchA-A',
                'experiment_id' => $dbExperiments[0]['id'],
                'content' => 'A-A',
                'priority' => 4,
                'allow_filter' => 'admin',
                'weight' => 50,
                'userid_list' => '1, 631736'
            ],
            [
                'name' => 'branchA-B',
                'experiment_id' => $dbExperiments[0]['id'],
                'content' => 'A-B',
                'priority' => 1,
                'allow_filter' => null,
                'weight' => 50,
            ],
            [
                'name' => 'branchA-C',
                'experiment_id' => $dbExperiments[0]['id'],
                'content' => 'A-C',
                'priority' => 3,
                'allow_filter' => 'admin',
                'weight' => 40,
            ],
            [
                'name' => 'branchB-A',
                'experiment_id' => $dbExperiments[1]['id'],
                'content' => 'B-A',
                'priority' => 1,
                'allow_filter' => null,
                'weight' => 1,
            ],
            [
                'name' => 'branchB-B',
                'experiment_id' => $dbExperiments[1]['id'],
                'content' => 'B-B',
                'priority' => 2,
                'allow_filter' => 'admin',
                'weight' => 6,
            ]
        ];

        foreach($features as $feature) {
            Feature::create($feature);
        }
        foreach($branches as $branch) {
            Branch::create($branch);
        }
    }
}
