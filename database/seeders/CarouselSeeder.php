<?php

namespace Database\Seeders;

use App\Models\Carousel;
use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carousels = [
            [
                'brand_id' => 1,
                'name' => '',
                'title' => 'SONGS UPGRADE',
                'description' => 'Drumeo students can now use our 5000+ note-for-note song transcriptions along with a drumless track. Try it out today and put yourself in the shoes of your favorite drummer!',
                'btn_text' => 'PLAY SONGS',
                'cta_url' => 'https://www.musora.com/drumeo/songs',
                'thumbnail' => 'https://imagedelivery.net/0Hon__GSkIjm-B_W77SWCA/96bf5455-7e05-4f20-8300-fd533662c300/w=1536,sharpen=3',
                'display_order' => 1
            ],
            [
                'brand_id' => 1,
                'name' => '',
                'title' => 'INTRODUCING MUSORA',
                'description' => 'A unified learning platform that includes Drumeo, Pianote, Guitareo, and Singeo. You now have an all-access pass to all four platforms at no additional cost.',
                'btn_text' => 'LEARN MORE',
                'cta_url' => 'https://www.musora.com/unified-2022',
                'thumbnail' => 'https://musora-web-platform.s3.amazonaws.com/carousel/musora-header-large+new.jpg',
                'display_order' => 2
            ],
            [
                'brand_id' => 1,
                'name' => '',
                'title' => 'NEW SONG RELEASES',
                'description' => 'January 11th - Student Request - 15 New Songs
January 18th - Songs Lottery - 50 New Songs
January 25th - Drumeo\'s Choice - 25 New Songs',
                'btn_text' => 'GO TO SONGS',
                'cta_url' => 'https://www.musora.com/drumeo/songs',
                'thumbnail' => 'https://musora-web-platform.s3.amazonaws.com/carousel/Songs-banner.jpg',
                'display_order' => 3
            ],
            [
                'brand_id' => 1,
                'name' => '',
                'title' => 'STUDENT FOCUS',
                'description' => 'Submit a video to be reviewed by a Drumeo instructor!',
                'btn_text' => 'APPLY FOR REVIEW',
                'cta_url' => 'https://www.musora.com/drumeo/student-focus',
                'thumbnail' => 'https://musora-web-platform.s3.amazonaws.com/carousel/JanStudentFocusBannerBLogoC.jpg',
                'display_order' => 4
            ],
            [
                'brand_id' => 2,
                'name' => '',
                'title' => '1000+ SONGS TO LEARN',
                'description' => 'Songs that are automatically synced to sheet music with audio tracks. You can adjust the speed, create practice loops, and play with or without the metronome. Check out our library and choose your favorite now!',
                'btn_text' => 'PLAY SONGS',
                'cta_url' => 'https://www.musora.com/pianote/songs',
                'thumbnail' => 'https://imagedelivery.net/0Hon__GSkIjm-B_W77SWCA/6f6d73a3-67b9-44b2-1f9e-77c4bc870c00/w=1536,sharpen=3',
                'display_order' => 1
            ],
            [
                'brand_id' => 2,
                'name' => '',
                'title' => 'INTRODUCING MUSORA',
                'description' => 'A unified learning platform that includes Drumeo, Pianote, Guitareo, and Singeo. You now have an all-access pass to all four platforms at no additional cost.',
                'btn_text' => 'LEARN MORE',
                'cta_url' => 'https://www.musora.com/unified-2022',
                'thumbnail' => 'https://musora-web-platform.s3.amazonaws.com/carousel/musora-header-large+new.jpg',
                'display_order' => 2
            ],
            [
                'brand_id' => 2,
                'name' => '',
                'title' => 'SUMMER SWEE-SINGH',
                'description' => 'Summer Swee-Singh is a composer, music arranger, pianist, keyboardist, string contractor, music director, backing vocalist, and music educator.',
                'btn_text' => 'Visit Summer\'s Coach Page',
                'cta_url' => 'https://www.musora.com/pianote/coaches/summer-swee-singh/369384',
                'thumbnail' => 'https://musora-web-platform.s3.amazonaws.com/carousel/pianote-COTM-summer-swee-singh.jpg',
                'display_order' => 3
            ],
            [
                'brand_id' => 2,
                'name' => '',
                'title' => 'THE PIANO BENCH',
                'description' => 'Join us for this incredibly fun live event where you will be inspired, have your questions answered, and stay up to date on what’s happening inside the Pianote Community!',
                'btn_text' => 'Check out the schedule here',
                'cta_url' => 'https://www.musora.com/pianote/schedule',
                'thumbnail' => 'https://musora-web-platform.s3.amazonaws.com/carousel/2022-06-29-Lisa-Kevin-Boogie-Woogie-101-107.jpg',
                'display_order' => 4
            ],
            [
                'brand_id' => 3,
                'name' => '',
                'title' => '1000+ SONGS TO LEARN',
                'description' => 'Songs that are automatically synced to sheet music with audio tracks. You can adjust the speed, create practice loops, and play with or without the metronome. Check out our library and choose your favorite now!',
                'btn_text' => 'PLAY SONGS',
                'cta_url' => 'https://www.musora.com/guitareo/songs',
                'thumbnail' => 'https://imagedelivery.net/0Hon__GSkIjm-B_W77SWCA/14786854-bbfc-49fa-c75b-64da6da7e800/w=1536,sharpen=3',
                'display_order' => 1
            ],
            [
                'brand_id' => 3,
                'name' => '',
                'title' => 'INTRODUCING MUSORA',
                'description' => 'A unified learning platform that includes Drumeo, Pianote, Guitareo, and Singeo. You now have an all-access pass to all four platforms at no additional cost.',
                'btn_text' => 'LEARN MORE',
                'cta_url' => 'https://www.musora.com/unified-2022',
                'thumbnail' => 'https://musora-web-platform.s3.amazonaws.com/carousel/musora-header-large+new.jpg',
                'display_order' => 2
            ],
            [
                'brand_id' => 3,
                'name' => 'COACH OF THE MONTH',
                'title' => 'DEAN LAMB',
                'description' => 'Dean is a Canadian born guitarist, best know for his work in the Extreme Technical Death Metal band Archspire. He is also a content creator on YouTube, doing instructional guitar related content.',
                'btn_text' => 'Visit Dean\'s Coach Page',
                'cta_url' => 'https://www.musora.com/guitareo/coaches/dean-lamb/354026',
                'thumbnail' => 'https://musora-web-platform.s3.amazonaws.com/carousel/guitareo-COTM-dean-lamb.jpg',
                'display_order' => 3
            ],
            [
                'brand_id' => 4,
                'name' => '',
                'title' => '1000+ SONGS TO LEARN',
                'description' => 'Songs that are automatically synced to sheet music with audio tracks. You can adjust the speed, create practice loops, and play with or without the metronome. Check out our library and choose your favorite now!',
                'btn_text' => 'PLAY SONGS',
                'cta_url' => 'https://www.musora.com/singeo/songs',
                'thumbnail' => 'https://imagedelivery.net/0Hon__GSkIjm-B_W77SWCA/4177b05e-b7c6-4782-b835-9db7ca5d0800/w=1536,sharpen=3',
                'display_order' => 1
            ],
            [
                'brand_id' => 4,
                'name' => '',
                'title' => 'INTRODUCING MUSORA',
                'description' => 'A unified learning platform that includes Drumeo, Pianote, Guitareo, and Singeo. You now have an all-access pass to all four platforms at no additional cost.',
                'btn_text' => 'LEARN MORE',
                'cta_url' => 'https://www.musora.com/unified-2022',
                'thumbnail' => 'https://musora-web-platform.s3.amazonaws.com/carousel/musora-header-large+new.jpg',
                'display_order' => 2
            ],
            [
                'brand_id' => 4,
                'name' => 'COACH OF THE MONTH',
                'title' => 'HAILEY BENEDICT',
                'description' => 'Hailey Benedict is a Canadian country singer and songwriter and a five-time North America Country Music Association International Youth winner. She’s opened for several internationally recognized artists like Jason Aldean, Blue Rodeo, Lindsay Ell, and Doc Walker.',
                'btn_text' => 'Visit Hailey\'s Coach Page',
                'cta_url' => 'https://www.musora.com/singeo/coaches/hailey-benedict/373871',
                'thumbnail' => 'https://d1923uyy6spedc.cloudfront.net/CoachCardPack-Hailey_Coach-Featured-Top-Bottom-Banner-1667243203.jpg',
                'display_order' => 3
            ],
            [
                'brand_id' => 4,
                'name' => '',
                'title' => 'THE STAGE',
                'description' => 'Join us for this incredibly fun live event where you will be inspired, have your questions answered, and stay up to date on what’s happening inside the Singeo Community!',
                'btn_text' => 'Check out the schedule here',
                'cta_url' => 'https://www.musora.com/singeo/schedule',
                'thumbnail' => 'https://musora-web-platform.s3.amazonaws.com/carousel/2022-05-04-Singeo-Julia-Lisa-100.jpg',
                'display_order' => 4
            ],
        ];

        foreach($carousels as $carousel){
            Carousel::create([
                'brand_id' => $carousel['brand_id'],
                'name' => $carousel['name'],
                'title' => $carousel['title'],
                'description' => $carousel['description'],
                'btn_text' => $carousel['btn_text'],
                'cta_url' => $carousel['cta_url'],
                'thumbnail' => $carousel['thumbnail'],
                'display_order' => $carousel['display_order']
            ]);
        }
    }
}
