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

class CoachBulkImageUpdate extends Command
{
    protected $name = 'CoachBulkDataUpdate';
    protected $signature = 'coaches:bulkUpdateImages {fileName} {startIndex=0} {endIndex=-1}';
    protected $description = 'Bulk update coach images from file';

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
                $contentId = $this->getValue($data, $headersRow, 'id');

                /** @var Instructor $instructor */
                $instructor = Instructor::query()
                    ->where('type', '=', 'instructor')
                    ->where('id', '=', $contentId)
                    ->first();

                $instructor->setCardImage($this->getValue($data, $headersRow, 'coach_card_image'));
                $instructor->setBottomBannerImage($this->getValue($data, $headersRow, 'coach_bottom_banner_image'));
                $instructor->setTopBannerImage($this->getValue($data, $headersRow, 'coach_top_banner_image'));
                $instructor->setFeaturedImage($this->getValue($data, $headersRow, 'coach_featured_image'));

                $instructor->save();
                $contentIds[] = $contentId;
            }
        );

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
}
