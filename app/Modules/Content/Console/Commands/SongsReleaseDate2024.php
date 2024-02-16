<?php

namespace App\Modules\Content\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Content\Models\Content;
use Exception;
use Railroad\Railcontent\Services\ContentService;

class SongsReleaseDate2024 extends Command
{
    protected $signature = 'content:songsReleaseDate2024 {startIndex=0} {endIndex=-1}';
    protected $description = 'Import filters data from CSV file';


    public function handle(
        ContentService $contentService
    ) {
        $startIndex = $this->argument('startIndex');
        $endIndex = $this->argument('endIndex');

        [$csv, $headersRow] = $this->getCSV($startIndex, $endIndex);

        $this->withProgressBar(
            $csv,
            function ($row) use ($headersRow, $contentService) {
                $data = $this->getData($row, $headersRow);

                $contentId = $this->getValue($data, $headersRow, 'ID');

                $content = Content::query()
                    ->where('id', '=', $contentId)
                    ->first();

                if (!$content) {
                    $this->info('Not exists  '.$contentId);
                } else {
                    $content->setReleased($this->getValue($data, $headersRow, 'RELEASED'));
                }
            }
        );

        $this->info('Done.');
    }

    public function getCSV(int $startIndex, int $endIndex): array
    {
        $fileName = 'releaseDate2024.csv';
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
