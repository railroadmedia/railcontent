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
    protected $signature = 'challenge:bulkUpdate {startIndex=0} {endIndex=-1}';
    protected $description = 'Bulk update challenge data from file';

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
                //$this->info("Updating Instructor $contentId");


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
                $content->setDescription($this->getValue($data, $headersRow, 'description'));
                $content->setEnrollmentStartDate($this->getValue($data, $headersRow, 'enrollment_start_date'));
                $content->setEnrollmentEndDate($this->getValue($data, $headersRow, 'enrollment_end_date'));
                $content->setOriginalThumb($this->getValue($data, $headersRow, 'original_thumbnail_url'));
                $content->setThumb($this->getValue($data, $headersRow, 'thumbnail_url'));
                $content->setLogo($this->getValue($data, $headersRow, 'logo_image_url'));
                $content->setHeaderImage($this->getValue($data, $headersRow, 'header_image_url'));
                $content->setVideo($this->getValue($data, $headersRow, 'video'));
                $content->setSoundsliceSlug($this->getValue($data, $headersRow, 'soundslice_slug'));

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
        $fileName = 'Challenge2023.csv';
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
