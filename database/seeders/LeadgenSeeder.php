<?php

namespace Database\Seeders;

use App\Models\Leadgen;
use App\Models\LeadgenLesson;
use App\Models\LeadgenLessonAsset;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeadgenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $leadgens = [
            [
                'brand_id' => 1,
                'title' => 'How to Play Drum Fills',
                'meta_desc' => 'Learn 20 beginner rock drum fills with Jared Falk of Drumeo. This is a free sample course, similar to the courses you\'d get when you join Drumeo.',
                'meta_img' => 'https://s3.amazonaws.com/drumeo-packs/drum-fills/1.png',
                'slug' => 'drum-fills',
                'lessons' => [
                    [
                        'slug' => 'drum-fills/1',
                        'title' => 'Part 1',
                        'desc' => '',
                        'thumbnail' => 'https://img.youtube.com/vi/O6Yd7XnYcPU/sddefault.jpg',
                        'video_src' => 'https://www.youtube.com/embed/O6Yd7XnYcPU',
                        'duration' => 12,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'drum-fills/2',
                        'title' => 'Part 2',
                        'desc' => '',
                        'thumbnail' => 'https://img.youtube.com/vi/0JOnroNveHw/sddefault.jpg',
                        'video_src' => 'https://www.youtube.com/embed/0JOnroNveHw',
                        'duration' => 13,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'drum-fills/3',
                        'title' => 'Part 3',
                        'desc' => '',
                        'thumbnail' => 'https://img.youtube.com/vi/_QrSJbBzZwk/sddefault.jpg',
                        'video_src' => 'https://www.youtube.com/embed/_QrSJbBzZwk',
                        'duration' => 15,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'drum-fills/4',
                        'title' => 'Part 4',
                        'desc' => '',
                        'thumbnail' => 'https://img.youtube.com/vi/9DETi6s4zD0/sddefault.jpg',
                        'video_src' => 'https://www.youtube.com/embed/9DETi6s4zD0',
                        'duration' => 13,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'drum-fills/5',
                        'title' => 'Part 5',
                        'desc' => '',
                        'thumbnail' => 'https://img.youtube.com/vi/vG5EKqx8MhU/sddefault.jpg',
                        'video_src' => 'https://www.youtube.com/embed/vG5EKqx8MhU',
                        'duration' => 5,
                        'assets' => [],
                    ],
                ],
            ],
            [
                'brand_id' => 1,
                'title' => 'How To Start Playing Drums',
                'meta_desc' => 'Get 5 free video lessons with YouTube-star COOP3RDRUMM3R, covering everything you need to start learning the drums for the very first time!',
                'meta_img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/share-image-drumeo.jpg',
                'slug' => 'coop3rdrumm3r/lessons',
                'lessons' => [
                    [
                        'slug' => 'coop3rdrumm3r/1-the-drum-set',
                        'title' => 'Understanding The Drum Set',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/551839388-a432e655008cce35ee73cec69639b3c801281023879f6a54a323f112782e7ef3-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/149674625',
                        'duration' => 8,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'coop3rdrumm3r/2-drum-theory',
                        'title' => 'Drum Theory',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/548962045-245c563e3dc6c0dfc39ffcd73ea0818c46579c70cf31b71c5f5ddf969b23580e-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/149674628',
                        'duration' => 8,
                        'assets' => [
                            [
                                'title' => 'Drum theory',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/cooperdrummer/2-drum-theory.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'coop3rdrumm3r/3-practice',
                        'title' => 'How To Practice',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/551839496-2316746236b066eb501ca6b120f2afb0e5d1a77dab1ee4902541021bbf2ebf79-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/149675118',
                        'duration' => 10,
                        'assets' => [
                            [
                                'title' => 'How to practicey',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/cooperdrummer/3-how-to-practice.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'coop3rdrumm3r/4-grooves',
                        'title' => 'Starter Grooves',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/548963870-f2b45bc2cf148787602cd2dd0cd604ee6df16a75b28d4b303eb01ff3e5a77c53-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/149674627',
                        'duration' => 10,
                        'assets' => [
                            [
                                'title' => 'Starter grooves',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/cooperdrummer/4-starter-grooves.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'coop3rdrumm3r/5-drum-fills',
                        'title' => 'Starter Fills',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/551839554-da5d348f09ac3cc5864cc2a4d0651e216216127609a1e657d1e2ba932f673eff-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/149674630',
                        'duration' => 10,
                        'assets' => [
                            [
                                'title' => 'Starter fills',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/cooperdrummer/5-starter-fills.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                ],
            ],
        ];

        Leadgen::truncate();
        LeadgenLesson::truncate();
        LeadgenLessonAsset::truncate();

        foreach($leadgens as $leadgen){
            $newLeadgen = Leadgen::create([
                'brand_id' => $leadgen['brand_id'],
                'title' => $leadgen['title'],
                'meta_desc' => $leadgen['meta_desc'],
                'meta_img' => $leadgen['meta_img'],
                'slug' => $leadgen['slug'],
            ]);

            foreach($leadgen['lessons'] as $key => $lesson){
                $newLesson = LeadgenLesson::create([
                    'leadgen_id' => $newLeadgen->id,
                    'title' => $lesson['title'],
                    'desc' => !empty($lesson['desc']) ? $lesson['desc'] : null,
                    'thumbnail' => $lesson['thumbnail'],
                    'video_src' => $lesson['video_src'],
                    'slug' => $lesson['slug'],
                    'duration' => $lesson['duration'],
                    'display_order' => $key + 1,
                ]);

                if(count($lesson['assets']) > 0){
                    foreach($lesson['assets'] as $asset){
                        LeadgenLessonAsset::create([
                            'leadgen_lesson_id' => $newLesson->id,
                            'title' => $asset['title'],
                            'src' => $asset['src'],
                            'soundslice' => !empty($asset['soundslice']) ? $asset['soundslice'] : null,
                        ]);
                    }
                }
            }
        }
    }
}
