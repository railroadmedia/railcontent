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

    public function handle(
        ContentService $contentService
    ) {
        $startIndex = $this->argument('startIndex');
        $endIndex = $this->argument('endIndex');

        [$csv, $headersRow] = $this->getCSV($startIndex, $endIndex);

        $contentIds = [];
        $video = [];
        $this->withProgressBar(
            $csv,
            function ($row) use ($headersRow, $contentService, &$contentIds, &$video) {
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
                $contentId = $content->id;
                $content->setTitle($contentTitle);
                $content->setDifficulty($this->getValue($data, $headersRow, 'Difficulty'));
                $content->setXP($this->getValue($data, $headersRow, 'XP'));
                $content->setTopic($this->getValue($data, $headersRow, 'Topic Filter'));
                $content->setInstructor($this->getValue($data, $headersRow, 'Instructor'));
                $content->setVideo($this->getValue($data, $headersRow, 'Video ID - Workouts'), $this->getValue($data, $headersRow, 'Duration'));
                $content->setSoundsliceSlug($this->getValue($data, $headersRow, 'SSID - Workouts'));

                if($content->video) {
                    $video[] = $content->video;
                }
                $contentIds[] = $contentId;
                event(new ContentCreated($contentId));

            }
        );

        $contentService->fillCompiledViewContentDataColumnForContentIds($video);

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
