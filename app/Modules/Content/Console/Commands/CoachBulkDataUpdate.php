<?php

namespace App\Modules\Content\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\Instructor;
use Exception;
use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Events\ElasticDataShouldUpdate;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Services\ContentDatumService;
use Railroad\Railcontent\Services\ContentFieldService;
use Railroad\Railcontent\Services\ContentService;

class CoachBulkDataUpdate extends Command
{
    protected $name = 'CoachBulkDataUpdate';
    protected $signature = 'coaches:bulkUpdate {fileName} {startIndex=0} {endIndex=-1}';
    protected $description = 'Bulk update coach data from file';

    public function handle(
        ContentService $contentService,
        ContentFieldService $contentFieldService,
        ContentDatumService $contentDatumService
    ) {
        $startIndex = $this->argument('startIndex');
        $endIndex = $this->argument('endIndex');

        [$csv, $headersRow] = $this->getCSV($startIndex, $endIndex);

        $contentIds = [];
        $this->withProgressBar(
            $csv,
            function ($row) use ($headersRow, $contentService, &$contentIds) {
                $data = $this->getData($row, $headersRow);
                $contentId = $this->getValue($data, $headersRow, 'id');
                //$this->info("Updating Instructor $contentId");

                /** @var Instructor $instructor */
                $instructor = Instructor::query()
                    ->where('type', '=', 'instructor')
                    ->where('id', '=', $contentId)
                    ->first();

                if (!$instructor) {
                    $instructor = new Instructor();
                    $instructor->slug = $this->getValue($data, $headersRow, 'slug');
                    $instructor->status = ContentService::STATUS_PUBLISHED;
                    $instructor->brand = $this->getValue($data, $headersRow, 'brand');
                    $instructor->published_on = $instructor->created_on;

                    $instructor->save();
                    $contentId = $instructor->id;
                }

                $instructor->setIsCoach($this->getValue($data, $headersRow, 'is_a_coach'));

                $instructor->setIsCoachOfTheMonth($this->getValue($data, $headersRow, 'is_coach_of_the_month'));
                $instructor->setIsFeatured($this->getValue($data, $headersRow, 'is_featured'));
                $instructor->setIsActive($this->getValue($data, $headersRow, 'is_active'));

                $instructor->setFocusTags($this->getValue($data, $headersRow, 'focus_tags'));
                $instructor->setStyleTags($this->getValue($data, $headersRow, 'style_tags'));
                $instructor->setCardShortDescription(
                    $this->getValue($data, $headersRow, 'coach_card_short_description')
                );
                $instructor->setShortBio($this->getValue($data, $headersRow, 'coach_short_bio'));
                $instructor->setLongBio($this->getValue($data, $headersRow, 'coach_long_bio'));

                //ignore all forum thread changes
                //$instructor->setForumThreadId($this->getValue($data, $headersRow, 'forum_thread_id'));

                $instructor->setBands($this->getValue($data, $headersRow, 'coach_bands'));
                $instructor->setEndorsements($this->getValue($data, $headersRow, 'coach_endorsements'));
                $instructor->setFacebook($this->getValue($data, $headersRow, 'coach_facebook'));
                $instructor->setInstagram($this->getValue($data, $headersRow, 'coach_instagram'));
                $instructor->setTwitter($this->getValue($data, $headersRow, 'coach_twitter'));
                $instructor->setTiktok($this->getValue($data, $headersRow, 'coach_tiktok'));
                $instructor->setYouTube($this->getValue($data, $headersRow, 'coach_youtube'));

                $instructor->save();
                $contentIds[] = $contentId;


                //delete cache associated with the content id
                //CacheHelper::deleteCache('content_'.$contentId);
                //CacheHelper::deleteUserFields(null, 'contents');
                event(new ElasticDataShouldUpdate($contentId));
            }
        );

        //Can be removed if this method is used again.
        $this->fixSpecificData();

        $contentService->fillCompiledViewContentDataColumnForContentIds($contentIds);

        $this->info('Done.');
    }

    public function getCSV(int $startIndex, int $endIndex): array
    {
        $fileName = $this->argument('fileName');
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


    private function fixSpecificData()
    {
        /** @var Instructor $instructor */
        $instructor = Instructor::query()
            ->where('type', '=', 'instructor')
            ->where('id', '=', 233797)
            ->first();

        $instructor->setName('BABY BOY DRUMMER');
        $instructor->save();
    }
}
