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
            $table->string('name');
        });

        Carousel::truncate();

        $carousels = [
            //Drumeo
            [
                'brand_id' => 1,
                'logo' => '',
                'subtitle' => '',
                'title' => 'Eloy Casagrande Live',
                'name' => 'Eloy Casagrande Live',
                'description' => 'Join us LIVE in the Drumeo studio with Eloy:<br>
May 8th (2:30PM PT) - The Drum Department<br>
May 10th (3:00PM PT) - Drumeo Live Lesson',
                'primary_cta_text' => 'More Info',
                'primary_cta_text_alt' => '',
                'primary_cta_url' => '',
                'primary_cta_url_alt' => '',
                'secondary_cta_text' => '',
                'secondary_cta_url' => '',
                'desktop_img' => '',
                'tablet_img' => '',
                'mobile_img' => '',
                'display_order' => 1,
                'start_date' => '01/05/2023, 8:00',
                'end_date' => '10/05/2023, 23:59',
            ],
            [
                'brand_id' => 1,
                'logo' => '',
                'subtitle' => '',
                'title' => 'Win a $100 Amazon Gift Card',
                'name' => 'Win a $100 Amazon Gift Card',
                'description' => 'Love your friends like you love music. Refer a friend to Drumeo and you could win a $100 Amazon gift card. The contest ends on May 8, 2023.',
                'primary_cta_text' => 'ENTER THE CONTEST',
                'primary_cta_text_alt' => '',
                'primary_cta_url' => 'https://www.musora.com/drumeo/referral/invite-a-friend',
                'primary_cta_url_alt' => '',
                'secondary_cta_text' => '',
                'secondary_cta_url' => '',
                'desktop_img' => '',
                'tablet_img' => '',
                'mobile_img' => '',
                'display_order' => 2,
                'start_date' => '06/04/2023, 11:22',
                'end_date' => '08/05/2023, 23:22',
            ],
            [
                'brand_id' => 1,
                'logo' => '',
                'subtitle' => '',
                'title' => '',
                'name' => '',
                'description' => '',
                'primary_cta_text' => '',
                'primary_cta_text_alt' => '',
                'primary_cta_url' => '',
                'primary_cta_url_alt' => '',
                'secondary_cta_text' => '',
                'secondary_cta_url' => '',
                'desktop_img' => '',
                'tablet_img' => '',
                'mobile_img' => '',
                'display_order' => 3,
                'start_date' => '',
                'end_date' => '',
            ],
            //Pianote
            [
                'brand_id' => 2,
                'logo' => '',
                'subtitle' => '',
                'title' => 'Win a $100 Amazon Gift Card',
                'name' => 'Win a $100 Amazon Gift Card',
                'description' => 'Love your friends like you love music. Refer a friend to Drumeo and you could win a $100 Amazon gift card. The contest ends on May 8, 2023.',
                'primary_cta_text' => 'ENTER THE CONTEST',
                'primary_cta_text_alt' => '',
                'primary_cta_url' => 'https://www.musora.com/pianote/referral/invite-a-friend',
                'primary_cta_url_alt' => '',
                'secondary_cta_text' => '',
                'secondary_cta_url' => '',
                'desktop_img' => '',
                'tablet_img' => '',
                'mobile_img' => '',
                'display_order' => 1,
                'start_date' => '06/04/2023, 11:22',
                'end_date' => '08/05/2023, 23:22',
            ],
            [
                'brand_id' => 2,
                'logo' => '',
                'subtitle' => '',
                'title' => '1000+ SONGS TO LEARN',
                'name' => 'Song Feature',
                'description' => 'Songs that are automatically synced to sheet music with audio tracks. You can adjust the speed, create practice loops, and play with or without the metronome. Check out our library and choose your favorite now!',
                'primary_cta_text' => 'PLAY SONGS',
                'primary_cta_text_alt' => '',
                'primary_cta_url' => 'https://www.musora.com/pianote/songs',
                'primary_cta_url_alt' => '',
                'secondary_cta_text' => '',
                'secondary_cta_url' => '',
                'desktop_img' => '',
                'tablet_img' => '',
                'mobile_img' => '',
                'display_order' => 2,
                'start_date' => '',
                'end_date' => '',
            ],
            [
                'brand_id' => 2,
                'logo' => '',
                'subtitle' => '',
                'title' => '',
                'name' => '',
                'description' => '',
                'primary_cta_text' => '',
                'primary_cta_text_alt' => '',
                'primary_cta_url' => '',
                'primary_cta_url_alt' => '',
                'secondary_cta_text' => '',
                'secondary_cta_url' => '',
                'desktop_img' => '',
                'tablet_img' => '',
                'mobile_img' => '',
                'display_order' => 3,
                'start_date' => '',
                'end_date' => '',
            ],
            //Guitareo
            [
                'brand_id' => 3,
                'logo' => '',
                'subtitle' => '',
                'title' => 'Win a $100 Amazon Gift Card',
                'name' => 'Win a $100 Amazon Gift Card',
                'description' => 'Love your friends like you love music. Refer a friend to Drumeo and you could win a $100 Amazon gift card. The contest ends on May 8, 2023.',
                'primary_cta_text' => 'ENTER THE CONTEST',
                'primary_cta_text_alt' => '',
                'primary_cta_url' => 'https://www.musora.com/guitareo/referral/invite-a-friend',
                'primary_cta_url_alt' => '',
                'secondary_cta_text' => '',
                'secondary_cta_url' => '',
                'desktop_img' => '',
                'tablet_img' => '',
                'mobile_img' => '',
                'display_order' => 1,
                'start_date' => '06/04/2023, 11:22',
                'end_date' => '08/05/2023, 23:22',
            ],
            [
                'brand_id' => 3,
                'logo' => '',
                'subtitle' => '',
                'title' => '',
                'name' => '',
                'description' => '',
                'primary_cta_text' => '',
                'primary_cta_text_alt' => '',
                'primary_cta_url' => '',
                'primary_cta_url_alt' => '',
                'secondary_cta_text' => '',
                'secondary_cta_url' => '',
                'desktop_img' => '',
                'tablet_img' => '',
                'mobile_img' => '',
                'display_order' => 2,
                'start_date' => '',
                'end_date' => '',
            ],
            //Singeo
            [
                'brand_id' => 4,
                'logo' => '',
                'subtitle' => '',
                'title' => 'Win a $100 Amazon Gift Card',
                'name' => 'Win a $100 Amazon Gift Card',
                'description' => 'Love your friends like you love music. Refer a friend to Drumeo and you could win a $100 Amazon gift card. The contest ends on May 8, 2023.',
                'primary_cta_text' => 'ENTER THE CONTEST',
                'primary_cta_text_alt' => '',
                'primary_cta_url' => 'https://www.musora.com/singeo/referral/invite-a-friend',
                'primary_cta_url_alt' => '',
                'secondary_cta_text' => '',
                'secondary_cta_url' => '',
                'desktop_img' => '',
                'tablet_img' => '',
                'mobile_img' => '',
                'display_order' => 1,
                'start_date' => '06/04/2023, 11:22',
                'end_date' => '08/05/2023, 23:22',
            ],
            [
                'brand_id' => 4,
                'logo' => '',
                'subtitle' => '',
                'title' => '1000+ SONGS TO LEARN',
                'name' => 'Song Feature',
                'description' => 'Songs that are automatically synced to sheet music with audio tracks. You can adjust the speed, create practice loops, and play with or without the metronome. Check out our library and choose your favorite now!',
                'primary_cta_text' => 'PLAY SONGS',
                'primary_cta_text_alt' => '',
                'primary_cta_url' => 'https://www.musora.com/singeo/songs',
                'primary_cta_url_alt' => '',
                'secondary_cta_text' => '',
                'secondary_cta_url' => '',
                'desktop_img' => '',
                'tablet_img' => '',
                'mobile_img' => '',
                'display_order' => 2,
                'start_date' => '',
                'end_date' => '',
            ],
            [
                'brand_id' => 4,
                'logo' => '',
                'subtitle' => '',
                'title' => '',
                'name' => '',
                'description' => '',
                'primary_cta_text' => '',
                'primary_cta_text_alt' => '',
                'primary_cta_url' => '',
                'primary_cta_url_alt' => '',
                'secondary_cta_text' => '',
                'secondary_cta_url' => '',
                'desktop_img' => '',
                'tablet_img' => '',
                'mobile_img' => '',
                'display_order' => 3,
                'start_date' => '',
                'end_date' => '',
            ],
        ];

        foreach($carousels as $carousel){
            Carousel::create([
                'brand_id' => $carousel['brand_id'],
                'logo' => $carousel['logo'],
                'subtitle' => $carousel['subtitle'],
                'title' => $carousel['title'],
                'name' => $carousel['name'],
                'description' => $carousel['description'],
                'desc_color' => !empty($carousel['desc_color']) ? $carousel['desc_color'] : null,
                'start_date' => !empty($carousel['start_date']) ? $carousel['start_date'] : null,
                'end_date' => !empty($carousel['end_date']) ? $carousel['end_date'] : null,
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
            $table->dropColumn('name');
        });
    }
};
