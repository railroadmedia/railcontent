<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trial_sections', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id');
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->longText('description');
            $table->string('tagline')->nullable();
            $table->string('desktop_img');
            $table->string('tablet_img')->nullable();
            $table->string('mobile_img')->nullable();
            $table->integer('product_id');
            $table->string('trailer')->nullable();
            $table->integer('display_order');
            $table->timestamps();
        });

        $lists = [
            [
                'brand_id' => 1,
                'title' => 'Get To Playing Songs Fast',
                'subtitle' => '30-Day Drumming Quick-Start',
                'description' => 'Learn by actually playing the drums. By focusing on timing & coordination.',
                'tagline' => 'Best Rated Course',
                'desktop_img' => 'https://imagedelivery.net/0Hon__GSkIjm-B_W77SWCA/4487c685-3f71-40fe-9697-c7ae14638200/public',
                'product_id' => 402199,
                'trailer' => 'https://player.vimeo.com/video/825206369?h=e8d828248a&autoplay=1',
                'display_order' => 1,
            ],
            [
                'brand_id' => 1,
                'title' => 'Learn Everything, Slowly',
                'subtitle' => 'A Lifetime of Learning',
                'description' => 'Follow our extensive step=by-step curriculum that will take you from your first hits.',
                'desktop_img' => 'https://imagedelivery.net/0Hon__GSkIjm-B_W77SWCA/afea1626-b9ed-4963-2285-aab5acefa700/public',
                'product_id' => 241247,
                'trailer' => 'https://player.vimeo.com/video/825206369?h=e8d828248a&autoplay=1',
                'display_order' => 2,
            ]
        ];

        foreach ($lists as $item) {
            \App\Models\TrialSection::create($item);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trial_sections');
    }
};
