<?php

namespace App\Modules\Content\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Content\Models\Content;
use Carbon\Carbon;
use Exception;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Services\ContentService;

class ChallengesImport2023 extends Command
{
    protected $name = 'ChallengesImport2023';
    protected $signature = 'workouts:import-challenges {startIndex=0} {endIndex=-1}';
    protected $description = 'Import challenge data from file';

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
    ) {
        $startIndex = $this->argument('startIndex');
        $endIndex = $this->argument('endIndex');

        [$csv, $headersRow] = $this->getCSV($startIndex, $endIndex);

        $contentIds = [];
        $challengePartIds = [];
        $this->withProgressBar(
            $csv,
            function ($row) use ($headersRow, $contentService, &$contentIds, &$challengePartIds) {
                $data = $this->getData($row, $headersRow);
                $contentTitle = $this->getValue($data, $headersRow, 'title');
                $contentType = $this->getValue($data, $headersRow, 'type');


                $content = Content::query()
                    ->where('type', '=', $contentType)
                    ->where('title', '=', $contentTitle)
                    ->first();

                if (!$content) {
                    $content = new Content();
                    $content->type = $contentType;
                    $content->slug = ContentHelper::slugify($contentTitle);
                    $content->status = $this->getValue($data, $headersRow, 'status');
                    $content->brand = $this->getValue($data, $headersRow, 'brand');
                    $content->published_on = $this->getValue($data, $headersRow, 'published_on');
                    $content->language = 'en-US';
                    $content->created_on = Carbon::now()->toDateTimeString();

                    $content->save();

                }
                $contentId = $content->id;
                $content->setTitle($contentTitle);
                $content->setDifficulty($this->getValue($data, $headersRow, 'difficulty'));
                $content->setXP($this->getValue($data, $headersRow, 'xp'));
                $content->setRegistrationUrl($this->getValue($data, $headersRow, 'registration_url'));
                $content->setTopic($this->getValue($data, $headersRow, 'topic'));
                $content->setInstructor($this->getValue($data, $headersRow, 'instructor'));
                $content->setSoundsliceSlug($this->getValue($data, $headersRow, 'soundslice_slug'));
                $content->setChapter($this->getValue($data, $headersRow, 'Chapter 1'), 1, self::CHAPTER_THUMBS[$content->brand][0]);
                $content->setChapter($this->getValue($data, $headersRow, 'Chapter 2'), 2, self::CHAPTER_THUMBS[$content->brand][1]);
                $content->setChapter($this->getValue($data, $headersRow, 'Chapter 3'), 3, self::CHAPTER_THUMBS[$content->brand][2]);
                $content->setChapter($this->getValue($data, $headersRow, 'Chapter 4'), 4, self::CHAPTER_THUMBS[$content->brand][3]);
                $content->setChapter($this->getValue($data, $headersRow, 'Chapter 5'), 5, self::CHAPTER_THUMBS[$content->brand][4]);
                $content->setChapter($this->getValue($data, $headersRow, 'Chapter 6'), 6, self::CHAPTER_THUMBS[$content->brand][5]);


                $content->setDescription($this->getValue($data, $headersRow, 'description'));
                $content->setEnrollmentStartDate($this->getValue($data, $headersRow, 'enrollment_start_date'));
                $content->setEnrollmentEndDate($this->getValue($data, $headersRow, 'enrollment_end_date'));

                $content->setOriginalThumb($this->getValue($data, $headersRow, 'original_thumbnail_url'));
                $content->setThumb($this->getValue($data, $headersRow, 'thumbnail_url'));
                $content->setLogo($this->getValue($data, $headersRow, 'logo_image_url'));
                $content->setHeaderImage($this->getValue($data, $headersRow, 'header_image_url'));

                $content->setVideo($this->getValue($data, $headersRow, 'video'));


                $content->save();

                $parentTitle = $this->getValue($data, $headersRow, 'parent');
                if($parentTitle) {
                    $parent =
                        Content::query()
                            ->where('type', '=', 'challenge')
                            ->where('title', '=', $parentTitle)
                            ->first();

                    if ($parent) {
                        $content->setParentId($parent->id);
                        $challengePartIds[] = $content->id;
                        $content->save();
                    }
                }

                $contentIds[] = $contentId;


                //delete cache associated with the content id
                //CacheHelper::deleteCache('content_'.$contentId);
                //CacheHelper::deleteUserFields(null, 'contents');
                // event(new ElasticDataShouldUpdate($contentId));
            }
        );

        $contentService->fillCompiledViewContentDataColumnForContentIds($contentIds);
        $contentService->fillParentContentDataColumnForContentIds($challengePartIds);

        $this->info('Done.');
    }

    public function getCSV(int $startIndex, int $endIndex): array
    {
        $fileName = 'Challenge2023-2.csv';
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
