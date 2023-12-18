<?php

namespace App\Modules\Content\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Content\Models\Content;
use Carbon\Carbon;
use Exception;
use Railroad\Railcontent\Events\ContentCreated;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Services\ContentService;

class WorkoutsImport2023 extends Command
{
    protected $name = 'WorkoutsImport2023';
    protected $signature = 'workouts:import {startIndex=0} {endIndex=-1}';
    protected $description = 'Import workouts data from CSV file';

    const CHAPTER_THUMBS = [
        'drumeo' =>[
            'https://d1923uyy6spedc.cloudfront.net/Chapter1-1701464222.jpg',
'https://d1923uyy6spedc.cloudfront.net/Chapter2-1701464237.jpg',
'https://d1923uyy6spedc.cloudfront.net/Chapter3-1701464247.jpg',
'https://d1923uyy6spedc.cloudfront.net/Chapter4-1701464280.jpg',
'https://d1923uyy6spedc.cloudfront.net/Chapter5-1701464293.jpg',
'https://d1923uyy6spedc.cloudfront.net/Chapter6-1701464305.jpg'
        ],
        'guitareo' => [
            'https://d1923uyy6spedc.cloudfront.net/Chapter1-1701710727.jpg',
'https://d1923uyy6spedc.cloudfront.net/Chapter2-1701710743.jpg',
'https://d1923uyy6spedc.cloudfront.net/Chapter3-1701710752.jpg',
'https://d1923uyy6spedc.cloudfront.net/Chapter4-1701710765.jpg',
'https://d1923uyy6spedc.cloudfront.net/Chapter5-1701710774.jpg',
'https://d1923uyy6spedc.cloudfront.net/Chapter6-1701710783.jpg',
        ]
    ];

    const PERMISSIONS = [
'guitareo' =>[
    'basic' => [
        91,
        92,
        52
    ],
    'plus' => [92],
]
    ];

    public function handle(
        ContentService $contentService
    ) {
        $startIndex = $this->argument('startIndex');
        $endIndex = $this->argument('endIndex');

        [$csv, $headersRow] = $this->getCSV($startIndex, $endIndex);

        $contentIds = [];

        $this->withProgressBar(
            $csv,
            function ($row) use ($headersRow, $contentService, &$contentIds) {
                $data = $this->getData($row, $headersRow);

                $contentTitle = $this->getValue($data, $headersRow, 'Name');
                $contentType = 'workout';
                $content = Content::query()
                    ->where('type', '=', $contentType)
                    ->where('title', '=', $contentTitle)
                    ->first();

                if (!$content) {
                    $content = new Content();
                    $content->type = $contentType;
                    $content->slug = ContentHelper::slugify($contentTitle);
                    $content->status = 'published';
                    $content->brand = 'guitareo';
                    $content->published_on = '2023-12-28 00:01:00';
                    $content->language = 'en-US';
                    $content->created_on = Carbon::now()->toDateTimeString();

                    $content->save();

                }

                $content->published_on = '2023-12-28 00:01:00';
                $content->save();

                $contentId = $content->id;
                $content->setTitle($contentTitle);

                $content->setDifficulty($this->getValue($data, $headersRow, 'Difficulty'));
                $content->setXP($this->getValue($data, $headersRow, 'XP'));
                $content->setTopic($this->getValue($data, $headersRow, 'Topic Filter'));
                $content->setStyle($this->getValue($data, $headersRow, 'Style'));
                $content->setInstructor($this->getValue($data, $headersRow, 'Instructor'));
                $content->setSoundsliceSlug($this->getValue($data, $headersRow, 'SSID - Workouts'));
                $content->setChapter($this->getValue($data, $headersRow, 'Chapter 1'), 1, self::CHAPTER_THUMBS[$content->brand][0]);
                $content->setChapter($this->getValue($data, $headersRow, 'Chapter 2'), 2, self::CHAPTER_THUMBS[$content->brand][1]);
                $content->setChapter($this->getValue($data, $headersRow, 'Chapter 3'), 3, self::CHAPTER_THUMBS[$content->brand][2]);
                $content->setChapter($this->getValue($data, $headersRow, 'Chapter 4'), 4, self::CHAPTER_THUMBS[$content->brand][3]);
                $content->setChapter($this->getValue($data, $headersRow, 'Chapter 5'), 5, self::CHAPTER_THUMBS[$content->brand][4]);
                $content->setChapter($this->getValue($data, $headersRow, 'Chapter 6'), 6, self::CHAPTER_THUMBS[$content->brand][5]);
                $content->setInstructor($this->getValue($data, $headersRow, 'Instructor'));

                $isCopyright = $this->getValue($data, $headersRow, 'Copyright');
                if($isCopyright == 'Yes') {
                    $content->setPermissions(self::PERMISSIONS[$content->brand]['plus']);
                    $content->setVideo($this->getValue($data, $headersRow, 'Video ID - Workouts'), $this->getValue($data, $headersRow, 'Duration'),'youtube');
                }else{
                    $content->setPermissions(self::PERMISSIONS[$content->brand]['basic']);
                    $content->setVideo($this->getValue($data, $headersRow, 'Video ID - Workouts'), $this->getValue($data, $headersRow, 'Duration'),'vimeo');
                }

                $thumbnail = $this->getValue($data, $headersRow, 'Thumbnail Uploaded');
                if($thumbnail) {
                    $content->setThumb('https://musora-web-platform.s3.amazonaws.com/workouts/guitareo/'.$thumbnail);
                    $content->setOriginalThumb('https://musora-web-platform.s3.amazonaws.com/workouts/guitareo/'.$thumbnail);
                }
                if($content->video) {
                    $contentService->fillCompiledViewContentDataColumnForContentIds([$content->video]);
                }
                $contentIds[] = $contentId;
                event(new ContentCreated($contentId));

            }
        );

        $this->info('Done.');
    }

    public function getCSV(int $startIndex, int $endIndex): array
    {
        $fileName = 'Guitareo_Workouts_Content.csv';
        $filePath = app_path() . '/Modules/Content/Console/Commands/Data/' . $fileName;
        $file = file($filePath);
        $csv = array_map('str_getcsv', $file);
        $headersRow = $csv[0];
        unset($csv[0]);
        if ($endIndex == -1 or $endIndex > count($csv)) {
            $endIndex = count($csv);
        }
        $csv = array_slice($csv, $startIndex, $endIndex - $startIndex);
        return [$csv, $headersRow];
    }

    private function getData($row, $headersRow): array
    {
        $data = [];
        for ($i = 0; $i < count($row); $i++) {
            $data[$headersRow[$i]] = $row[$i];
        }
        return $data;
    }

    private function getValue(array $data, mixed $headersRow, string $name): ?string
    {
        if (!in_array($name, $headersRow)) {
            throw new Exception("Header '$name' does not exist in array");
        }

        return $data[$name] ?? "";
    }
}
