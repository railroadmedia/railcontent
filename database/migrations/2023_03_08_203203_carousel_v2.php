<?php

use App\Models\Carousel;
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
        //
        Schema::table('carousels', function (Blueprint $table) {
            $table->renameColumn('cta_text', 'primary_cta_text');
            $table->renameColumn('cta_url', 'primary_cta_url');
            $table->renameColumn('img', 'desktop_img');
            $table->renameColumn('product_url', 'primary_cta_url_alt');
            $table->string('primary_cta_text_alt')->nullable();
            $table->string('secondary_cta_text')->nullable();
            $table->string('secondary_cta_url')->nullable();
            $table->string('tablet_img');
            $table->string('mobile_img');
            $table->string('desc_color')->nullable();
            $table->dropColumn('endpoint');
        });

        Carousel::where('brand_id', 1)->update(['visible' => false]);

        $carousels = [
            [
                'brand_id' => 1,
                'logo' => 'https://d3fzm1tzeyr5n3.cloudfront.net/carousel/30DD2-logo.svg',
                'subtitle' => '',
                'title' => '',
                'description' => 'This 30-day guided training pack will help you play beautiful piano in the shortest possible time. By the end of this program, you’ll have the skills to learn hundreds of popular songs! 10-minute daily workouts that help build your piano skills for life. Registration is required but FREE for members.',
                'primary_cta_text' => 'Play songs',
                'primary_cta_text_alt' => 'Play songs',
                'primary_cta_url' => 'https://www.musora.com/drumeo/packs/30-day-drummer-season-2/383627/30-day-drummer-season-2/383628',
                'primary_cta_url_alt' => 'https://www.musora.com/drumeo/packs/30-day-drummer-season-2/383627/30-day-drummer-season-2/383628',
                'secondary_cta_text' => 'Learn more',
                'secondary_cta_url' => 'https://www.musora.com/drumeo/forums/jump-to-post/329017',
                'desktop_img' => 'https://d1fyshwdvi6fth.cloudfront.net/Pianote/carousels/4f7e99d9-c0a3-4498-980e-289aa9d85ce7-desktop.jpg',
                'tablet_img' => 'https://d1fyshwdvi6fth.cloudfront.net/Pianote/carousels/4f7e99d9-c0a3-4498-980e-289aa9d85ce7-tablet.jpg',
                'mobile_img' => 'https://d1fyshwdvi6fth.cloudfront.net/Pianote/carousels/4f7e99d9-c0a3-4498-980e-289aa9d85ce7-mobile.jpg',
                'display_order' => 1
            ],
            [
                'brand_id' => 1,
                'logo' => 'https://d1fyshwdvi6fth.cloudfront.net/Pianote/carousels/e2ae87f1-1bce-4f50-b5d1-b7cc6066a65f-Big Band Essentials_logo.svg',
                'subtitle' => '',
                'title' => '',
                'description' => 'Learn with the best in the business, Greyson Nekrutman.',
                'desc_color' => 'black',
                'primary_cta_text' => 'SEE GREYSONS LESSONS',
                'primary_cta_text_alt' => '',
                'primary_cta_url' => 'https://www.musora.com/drumeo/live',
                'primary_cta_url_alt' => '',
                'secondary_cta_text' => '',
                'secondary_cta_url' => '',
                'desktop_img' => 'https://d1fyshwdvi6fth.cloudfront.net/Pianote/carousels/e2ae87f1-1bce-4f50-b5d1-b7cc6066a65f-desktop.jpg',
                'tablet_img' => 'https://d1fyshwdvi6fth.cloudfront.net/Pianote/carousels/e2ae87f1-1bce-4f50-b5d1-b7cc6066a65f-tablet.jpg',
                'mobile_img' => 'https://d1fyshwdvi6fth.cloudfront.net/Pianote/carousels/e2ae87f1-1bce-4f50-b5d1-b7cc6066a65f-mobile.jpg',
                'display_order' => 2
            ],
            [
                'brand_id' => 1,
                'logo' => 'https://d1fyshwdvi6fth.cloudfront.net/Pianote/carousels/4e9d9b03-3040-49f7-b6c1-3524711151f7-spotlight-todd-sucherman_logo.svg',
                'subtitle' => '',
                'title' => '',
                'description' => 'See what’s new in the Spotlight series from Todd Sucherman.',
                'primary_cta_text' => 'Watch the show',
                'primary_cta_text_alt' => '',
                'primary_cta_url' => 'https://www.musora.com/drumeo/songs',
                'primary_cta_url_alt' => '',
                'secondary_cta_text' => '',
                'secondary_cta_url' => '',
                'desktop_img' => 'https://d1fyshwdvi6fth.cloudfront.net/Pianote/carousels/4e9d9b03-3040-49f7-b6c1-3524711151f7-desktop.jpg',
                'tablet_img' => 'https://d1fyshwdvi6fth.cloudfront.net/Pianote/carousels/4e9d9b03-3040-49f7-b6c1-3524711151f7-tablet.jpg',
                'mobile_img' => 'https://d1fyshwdvi6fth.cloudfront.net/Pianote/carousels/4e9d9b03-3040-49f7-b6c1-3524711151f7-mobile.jpg',
                'display_order' => 3
            ],
            [
                'brand_id' => 1,
                'logo' => 'https://d1fyshwdvi6fth.cloudfront.net/Pianote/carousels/1ca40765-24da-47d9-a62d-dcf70329201f-Beatles_logo 2.svg',
                'subtitle' => '',
                'title' => '',
                'description' => 'We have added 100 new songs by The Beatles!',
                'primary_cta_text' => 'SEE THEM IN SONGS',
                'primary_cta_text_alt' => '',
                'primary_cta_url' => 'https://www.musora.com/unified-2022',
                'primary_cta_url_alt' => '',
                'secondary_cta_text' => '',
                'secondary_cta_url' => '',
                'desktop_img' => 'https://d1fyshwdvi6fth.cloudfront.net/Pianote/carousels/2a3cff6a-938c-4728-a614-0600853bddce-desktop.jpg',
                'tablet_img' => 'https://d1fyshwdvi6fth.cloudfront.net/Pianote/carousels/1ca40765-24da-47d9-a62d-dcf70329201f-tablet.jpg',
                'mobile_img' => 'https://d1fyshwdvi6fth.cloudfront.net/Pianote/carousels/1ca40765-24da-47d9-a62d-dcf70329201f-mobile.jpg',
                'display_order' => 4
            ],
        ];

        foreach($carousels as $carousel){
            Carousel::create([
                'brand_id' => $carousel['brand_id'],
                'logo' => $carousel['logo'],
                'subtitle' => $carousel['subtitle'],
                'title' => $carousel['title'],
                'description' => $carousel['description'],
                'desc_color' => !empty($carousel['desc_color']) ? $carousel['desc_color'] : null,
                'primary_cta_text' => $carousel['primary_cta_text'],
                'primary_cta_text_alt' => $carousel['primary_cta_text_alt'],
                'secondary_cta_text' => $carousel['secondary_cta_text'],
                'primary_cta_url' => $carousel['primary_cta_url'],
                'primary_cta_url_alt' => $carousel['primary_cta_url_alt'],
                'secondary_cta_url' => $carousel['secondary_cta_url'],
                'desktop_img' => $carousel['desktop_img'],
                'tablet_img' => $carousel['tablet_img'],
                'mobile_img' => $carousel['mobile_img'],
                'display_order' => $carousel['display_order'],
                'is_featured' => 0
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('carousels', function (Blueprint $table) {
            $table->renameColumn('primary_cta_text', 'cta_text');
            $table->renameColumn('primary_cta_url', 'cta_url');
            $table->renameColumn('desktop_img', 'img');
            $table->renameColumn('primary_cta_url_alt', 'product_url');
            $table->dropColumn('primary_cta_text_alt');
            $table->dropColumn('secondary_cta_text');
            $table->dropColumn('secondary_cta_url');
            $table->dropColumn('tablet_img');
            $table->dropColumn('mobile_img');
            $table->dropColumn('desc_color');
            $table->string('endpoint');
        });
    }
};
