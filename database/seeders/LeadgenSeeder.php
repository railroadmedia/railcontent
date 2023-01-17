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
                        'assets' => [],
                    ],
                    [
                        'slug' => 'drum-fills/2',
                        'title' => 'Part 2',
                        'desc' => '',
                        'thumbnail' => 'https://img.youtube.com/vi/0JOnroNveHw/sddefault.jpg',
                        'video_src' => 'https://www.youtube.com/embed/0JOnroNveHw',
                        'assets' => [],
                    ],
                    [
                        'slug' => 'drum-fills/3',
                        'title' => 'Part 3',
                        'desc' => '',
                        'thumbnail' => 'https://img.youtube.com/vi/_QrSJbBzZwk/sddefault.jpg',
                        'video_src' => 'https://www.youtube.com/embed/_QrSJbBzZwk',
                        'assets' => [],
                    ],
                    [
                        'slug' => 'drum-fills/4',
                        'title' => 'Part 4',
                        'desc' => '',
                        'thumbnail' => 'https://img.youtube.com/vi/9DETi6s4zD0/sddefault.jpg',
                        'video_src' => 'https://www.youtube.com/embed/9DETi6s4zD0',
                        'assets' => [],
                    ],
                    [
                        'slug' => 'drum-fills/5',
                        'title' => 'Part 5',
                        'desc' => '',
                        'thumbnail' => 'https://img.youtube.com/vi/vG5EKqx8MhU/sddefault.jpg',
                        'video_src' => 'https://www.youtube.com/embed/vG5EKqx8MhU',
                        'assets' => [],
                    ],
                ],
            ],
        ];

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
