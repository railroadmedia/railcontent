<?php

namespace App\Modules\Content\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Content\Models\Content;
use Carbon\Carbon;
use Exception;
use Railroad\Railcontent\Events\ContentCreated;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Services\ContentService;

class ChallengesImport2023 extends Command
{
    protected $name = 'ChallengesImport2023';
    protected $signature = 'workouts:import-challenges {startIndex=0} {endIndex=-1}';
    protected $description = 'Import challenge data from file';


    public const PERMISSIONS = [
        'guitareo' => [
            'basic' => [
                91,
                92,
                52
            ],
            'plus' => [92],
        ],
        'drumeo' => [
            'basic' => [
                91,
                92,
                1
            ],
            'plus' => [92],
        ],
        'pianote' => [
            'basic' => [
                91,
                92,
                77
            ],
            'plus' => [92],
        ],
        'singeo' => [
            'basic' => [
                91,
                92,
                73
            ],
            'plus' => [92],
        ]
    ];

    public const CHAPTER_THUMBS = [
        'drumeo' => [
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
        ],
        'pianote' => [
            'https://d1923uyy6spedc.cloudfront.net/Chapter1-1701465546.jpg',
            'https://d1923uyy6spedc.cloudfront.net/Chapter2-1701465574.jpg',
            'https://d1923uyy6spedc.cloudfront.net/Chapter3-1701465607.jpg',
            'https://d1923uyy6spedc.cloudfront.net/Chapter4-1701465597.jpg',
            'https://d1923uyy6spedc.cloudfront.net/Chapter5-1701465655.jpg',
            'https://d1923uyy6spedc.cloudfront.net/Chapter6-1701465685.jpg',
        ],
        'singeo' => [
            'https://d1923uyy6spedc.cloudfront.net/Chapter1-1701711049.jpg',
            'https://d1923uyy6spedc.cloudfront.net/Chapter2-1701711065.jpg',
            'https://d1923uyy6spedc.cloudfront.net/Chapter3-1701711073.jpg',
            'https://d1923uyy6spedc.cloudfront.net/Chapter4-1701711184.jpg',
            'https://d1923uyy6spedc.cloudfront.net/Chapter5-1701711082.jpg',
            'https://d1923uyy6spedc.cloudfront.net/Chapter6-1701711089.jpg',
        ],
    ];

    public function handle(
        ContentService $contentService
    ): void {
        $startIndex = $this->argument('startIndex');
        $endIndex = $this->argument('endIndex');

        [$csv, $headersRow] = $this->getCSV($startIndex, $endIndex);

        $contentIds = [];
        $challengePartIds = [];
        $mappingIds = [];
        $this->withProgressBar(
            $csv,
            function ($row) use ($headersRow, $contentService, &$contentIds, &$challengePartIds, &$mappingIds) {
                $data = $this->getData($row, $headersRow);
                $stagingId = $this->getValue($data, $headersRow, 'id');

                $contentTitle = $this->getValue($data, $headersRow, 'title');
                $contentType = $this->getValue($data, $headersRow, 'type');
                $contentSlug = $this->getValue($data, $headersRow, 'slug');

                $content = Content::query()
                    ->where('type', '=', $contentType)
                    ->where('slug', '=', $contentSlug)
                    ->first();

                if (!$content) {
                    $content = new Content();
                    $content->type = $contentType;
                    $content->slug = $contentSlug;
                    $content->status = 'draft';
                    //$this->getValue($data, $headersRow, 'status');
                    $content->brand = $this->getValue($data, $headersRow, 'brand');
                    $content->published_on = $this->getValue($data, $headersRow, 'published_on');
                    $content->language = 'en-US';
                    $content->created_on = Carbon::now()->toDateTimeString();

                    $content->save();

                }
                $contentId = $content->id;
                $mappingIds[$stagingId] = $contentId;

                $content->setTitle($contentTitle);
                $content->setDifficulty($this->getValue($data, $headersRow, 'difficulty'));
                $content->setXP($this->getValue($data, $headersRow, 'xp'));
                $content->setTotalXP($this->getValue($data, $headersRow, 'total_xp'));
                $content->setRegistrationUrl($this->getValue($data, $headersRow, 'registration_url'));
                $content->setTopic($this->getValue($data, $headersRow, 'topic'));
                $content->setInstructor($this->getValue($data, $headersRow, 'instructor'));
                $content->setSoundsliceSlug($this->getValue($data, $headersRow, 'soundslice_slug'));
                $content->setPermissions(self::PERMISSIONS[$content->brand]['basic']);
                $chapter_1_d = $this->getValue($data, $headersRow, 'chapter_1_desc');
                $chapter_1_t = $this->getValue($data, $headersRow, 'chapter_1_timecode');
                $chapter_2_d = $this->getValue($data, $headersRow, 'chapter_2_desc');
                $chapter_2_t = $this->getValue($data, $headersRow, 'chapter_2_timecode');
                $chapter_3_d = $this->getValue($data, $headersRow, 'chapter_3_desc');
                $chapter_3_t = $this->getValue($data, $headersRow, 'chapter_3_timecode');
                $chapter_4_d = $this->getValue($data, $headersRow, 'chapter_4_desc');
                $chapter_4_t = $this->getValue($data, $headersRow, 'chapter_4_timecode');
                $chapter_5_d = $this->getValue($data, $headersRow, 'chapter_5_desc');
                $chapter_5_t = $this->getValue($data, $headersRow, 'chapter_5_timecode');
                $chapter_6_d = $this->getValue($data, $headersRow, 'chapter_6_desc');
                $chapter_6_t = $this->getValue($data, $headersRow, 'chapter_6_timecode');
                if($chapter_1_d != 'NULL' && $chapter_1_t != 'NULL') {
                    $content->setChapter($chapter_1_d.':'.$chapter_1_t, 1, self::CHAPTER_THUMBS[$content->brand][0]);
                }
                if($chapter_2_d != 'NULL' && $chapter_2_t != 'NULL') {
                    $content->setChapter($chapter_2_d.':'.$chapter_2_t, 2, self::CHAPTER_THUMBS[$content->brand][1]);
                }
                if($chapter_3_d != 'NULL' && $chapter_3_t != 'NULL') {
                    $content->setChapter($chapter_3_d.':'.$chapter_3_t, 3, self::CHAPTER_THUMBS[$content->brand][2]);
                }
                if($chapter_4_d != 'NULL' && $chapter_4_t != 'NULL') {
                    $content->setChapter($chapter_4_d.':'.$chapter_4_t, 4, self::CHAPTER_THUMBS[$content->brand][3]);
                }
                if($chapter_5_d != 'NULL' && $chapter_5_t != 'NULL') {
                    $content->setChapter($chapter_5_d.':'.$chapter_5_t, 5, self::CHAPTER_THUMBS[$content->brand][4]);
                }
                if($chapter_6_d != 'NULL' && $chapter_6_t != 'NULL') {
                    $content->setChapter($chapter_6_d.':'.$chapter_6_t, 6, self::CHAPTER_THUMBS[$content->brand][5]);
                }

                $content->setDescription($this->getValue($data, $headersRow, 'description'));
                $content->setOriginalThumb($this->getValue($data, $headersRow, 'original_thumbnail_url'));
                $content->setThumb($this->getValue($data, $headersRow, 'thumbnail_url'));
                $content->setLogo($this->getValue($data, $headersRow, 'logo_image_url'));
                $content->setHeaderImage($this->getValue($data, $headersRow, 'header_image_url'));

                if($this->getValue($data, $headersRow, 'vimeo_video_id') !== 'NULL' && $this->getValue($data, $headersRow, 'duration') !== 'NULL') {
                    $content->setVideo(
                        $this->getValue($data, $headersRow, 'vimeo_video_id'),
                        $this->getValue($data, $headersRow, 'duration'),
                        'vimeo'
                    );
                }

                $content->save();

                $stagingParentId = $this->getValue($data, $headersRow, 'parent_id');
                if($stagingParentId && isset($mappingIds[$stagingParentId])) {

                    $parentId = $mappingIds[$stagingParentId];
                    $content->setParentId($parentId, $this->getValue($data, $headersRow, 'child_position'));
                    $challengePartIds[] = $content->id;
                    $content->save();

                }

                $contentIds[] = $contentId;

                if($content->video) {
                    $contentService->fillCompiledViewContentDataColumnForContentIds([$content->video]);
                }
                event(new ContentCreated($contentId));

            }
        );

        //        $contentService->fillCompiledViewContentDataColumnForContentIds($contentIds);
        //        $contentService->fillParentContentDataColumnForContentIds($challengePartIds);

        $this->info('Done.');
    }

    public function getCSV(int $startIndex, int $endIndex): array
    {
        $fileName = 'challenges-2023-content.csv';
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
