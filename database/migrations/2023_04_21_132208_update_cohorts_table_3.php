<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::table('cohorts', function (Blueprint $table) {
            $table->dropColumn('icon1');
            $table->dropColumn('icon2');
            $table->dropColumn('icon3');

            $table->string('icon1_url')
                ->nullable();
            $table->string('icon2_url')
                ->nullable();
            $table->string('icon3_url')
                ->nullable();
        });

        $cohorts = [
            [
                'id' => 1,
                'icon1_url' => 'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/3aa8f78e-332c-4afa-00e9-ab4eeb8c2900/public',
                'icon2_url' => 'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/0d3970c5-8a64-4276-4fff-dda0bcfb0900/public',
                'icon3_url' => 'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/60a5d4c0-6dce-4f12-b1cb-a47996be1500/public',
            ],
            [
                'id' => 2,
                'icon1_url' => 'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/dd1c5c5b-c7c1-47d1-ecfb-9f05a548f200/public',
                'icon2_url' => 'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/17b5c92a-3e61-41d1-f282-e75d54888500/public',
                'icon3_url' => 'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/2cb4f469-9554-428d-47c9-97f4cd2fd900/public',
            ],
        ];

        foreach ($cohorts as $cohort) {
            $values = collect($cohort)->filter(function ($value, $key) {
                return $key != 'id';
            })->toArray();
            \App\Models\Cohort::query()->where('id', '=', $cohort['id'])->update($values);
        }
    }

    public function down()
    {
        Schema::table('cohorts', function (Blueprint $table) {
            $table->dropColumn('icon1_url');
            $table->dropColumn('icon2_url');
            $table->dropColumn('icon3_url');

            $table->string('icon1')
                ->nullable();
            $table->string('icon2')
                ->nullable();
            $table->string('icon3')
                ->nullable();
        });
    }
};
