<?php

namespace App\Modules\Content\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Content\Models\Content;
use Exception;
use Railroad\Railcontent\Services\ContentService;

class Filters20242 extends Command
{
    protected $signature = 'filters:import {brand=drumeo} {startIndex=0} {endIndex=-1}';
    protected $description = 'Import filters data from CSV file';


    public function handle(
        ContentService $contentService
    ) {
        $startIndex = $this->argument('startIndex');
        $endIndex = $this->argument('endIndex');
        $brand = $this->argument('brand');

        [$csv, $headersRow] = $this->getCSV($startIndex, $endIndex, $brand);

        $contentIds = [];

        $this->withProgressBar(
            $csv,
            function ($row) use ($headersRow, $contentService, &$contentIds, $brand) {
                $data = $this->getData($row, $headersRow);

                $contentId = $this->getValue($data, $headersRow, 'id');
                $contentType = $this->getValue($data, $headersRow, 'type');
                $contentTitle= $this->getValue($data, $headersRow, 'title');

                $content = Content::query()
                    ->where('type', '=', $contentType)
                    ->where('title', '=', $contentTitle)
                    ->where('id', '=', $contentId)
                    ->first();

                if (!$content) {
                    $this->info('Not exists  '.$contentId.'    '.$contentTitle);
                } else {
                    if($brand == 'drumeo-Rudiments') {
                        $content->setTopic($this->getValue($data, $headersRow, 'Topic'));
                        $content->setGear($this->getValue($data, $headersRow, 'Gear'));
                    }else {
                        $content->setEssentials($this->getValue($data, $headersRow, 'Essentials-1'));
                        $content->setEssentials($this->getValue($data, $headersRow, 'Essentials-2'));
                        $content->setTheory($this->getValue($data, $headersRow, 'Theory-1'));
                        $content->setTheory($this->getValue($data, $headersRow, 'Theory-2'));
                        $content->setCreativity($this->getValue($data, $headersRow, 'Creativity-1'));
                        $content->setCreativity($this->getValue($data, $headersRow, 'Creativity-2'));
                        $content->setLifestyle($this->getValue($data, $headersRow, 'Lifestyle-1'));
                        $content->setLifestyle($this->getValue($data, $headersRow, 'Lifestyle-2'));
                        $content->setGenre($this->getValue($data, $headersRow, 'Genre'));
                    }
                }
            }
        );

        $this->info('Done.');
    }

    public function getCSV(int $startIndex, int $endIndex, $brand): array
    {
        $nam = ucfirst($brand);
        $fileName = 'Filter-'.$nam.'.csv';
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
