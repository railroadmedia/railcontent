<?php

namespace App\Modules\Content\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\ContentStyle;
use Exception;
use Modules\Content\Models\ContentCreativity;
use Modules\Content\Models\ContentEssentials;
use Modules\Content\Models\ContentGears;
use Modules\Content\Models\ContentLifestyle;
use Modules\Content\Models\ContentTheory;
use Modules\Content\Models\ContentTopic;
use Railroad\Railcontent\Services\ContentService;


use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Helper\TableSeparator;

class Filters20242 extends Command
{
    protected $signature = 'filters:import {brand=drumeo} {--withImport} {--refreshCompiledViewData}';
    protected $description = 'Import filters data from CSV file';


    public function handle(
        ContentService $contentService
    ): void {
        $startIndex = 0;
        $endIndex = -1;
        $brand = $this->argument('brand');
        $import = $this->option('withImport');
        $refreshCompiledViewData = $this->option('refreshCompiledViewData');

        $table = new Table($this->output);

        // Set the table headers.
        $table->setHeaders([
            'Content Type', 'Style','Number'
        ]);


        // Render the table to the output.

        [$csv, $headersRow] = $this->getCSV($startIndex, $endIndex, $brand);

        $results = [];
        $contentIds = [];

        $this->withProgressBar(
            $csv,
            function ($row) use ($headersRow, $contentService, &$results, $brand, $import, &$contentIds) {
                $data = $this->getData($row, $headersRow);

                $contentId = $this->getValue($data, $headersRow, 'id');
                $contentIds[] = $contentId;
                if($brand == 'drumeo-songs') {
                    $contentType = 'song';
                } else {
                    $contentType = $this->getValue($data, $headersRow, 'type');
                }
                $contentTitle = $this->getValue($data, $headersRow, 'title');

                $content = Content::query()
                    ->where('type', '=', $contentType)
                    ->where('id', '=', $contentId)
                    ->first();

                if (!$content) {
                    $this->info('Not exists  '.$contentId.'    '.$contentTitle);
                } else {
                    if($brand == 'drumeo-Rudiments') {
                        $style = $this->getValue($data, $headersRow, 'Gear');
                    } elseif($brand == 'drumeo-songs') {
                        $style = $this->getValue($data, $headersRow, 'NEW-GENRE');
                    } else {
                        $style = $this->getValue($data, $headersRow, 'Genre');
                    }
                    $results[$contentType][$style] = ($results[$contentType][$style] ?? 0) + 1;
                    if ($import) {
                        if($brand == 'drumeo-Rudiments') {
                            ContentTopic::query()
                                        ->where('content_id', '=', $contentId)
                                        ->delete();

                            $content->deleteFields('topic');

                            ContentGears::query()
                                ->where('content_id', '=', $contentId)
                                ->delete();
                            $content->deleteFields('gear');

                            $content->setTopic($this->getValue($data, $headersRow, 'Topic'));
                            $content->setGear($this->getValue($data, $headersRow, 'Gear'));
                        } elseif($brand == 'drumeo-songs') {
                            ContentStyle::query()
                                ->where('content_id', '=', $contentId)
                                ->delete();
                            $content->deleteFields('style');
                            $content->setStyle($this->getValue($data, $headersRow, 'NEW-GENRE'));
                        } else {
                            $this->prepareDatabase($contentId, $content);

                            $content->setEssentials($this->getValue($data, $headersRow, 'Essentials-1'), 1);
                            $content->setEssentials($this->getValue($data, $headersRow, 'Essentials-2'), 2);
                            $content->setTheory($this->getValue($data, $headersRow, 'Theory-1'), 1);
                            $content->setTheory($this->getValue($data, $headersRow, 'Theory-2'), 2);
                            $content->setCreativity($this->getValue($data, $headersRow, 'Creativity-1'), 1);
                            $content->setCreativity($this->getValue($data, $headersRow, 'Creativity-2'), 2);
                            $content->setLifestyle($this->getValue($data, $headersRow, 'Lifestyle-1'), 1);
                            $content->setLifestyle($this->getValue($data, $headersRow, 'Lifestyle-2'), 2);
                            $content->setStyle($this->getValue($data, $headersRow, 'Genre'));
                        }
                    }
                }
            }
        );

        if($refreshCompiledViewData) {
            $contentService->fillCompiledViewContentDataColumnForContentIds($contentIds);
        }

        $separator = new TableSeparator();
        $roows = [];
        foreach ($results as $key => $result) {
            $roows[] = $separator;
            foreach($result as $key2 => $row) {
                $roows = array_merge($roows, [
                    [$key,   $key2,     $row],
                ]) ;
            }
        }

        // Set the contents of the table.
        $table->setRows($roows);
        $table->render();

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

    /**
     * @param string|null $contentId
     * @param \Illuminate\Database\Eloquent\Model|\App\Modules\Content\Builders\ContentBuilder|object $content
     */
    private function prepareDatabase(
        ?string $contentId,
        $content
    ): void {
        ContentCreativity::query()
            ->where('content_id', '=', $contentId)
            ->delete();
        $content->deleteFields('creativity');

        ContentEssentials::query()
            ->where('content_id', '=', $contentId)
            ->delete();
        $content->deleteFields('essentials');

        ContentTheory::query()
            ->where('content_id', '=', $contentId)
            ->first();

        $content->deleteFields('theory');

        ContentLifestyle::query()
            ->where('content_id', '=', $contentId)
            ->delete();
        $content->deleteFields('lifestyle');

        ContentStyle::query()
            ->where('content_id', '=', $contentId)
            ->delete();
        $content->deleteFields('style');
    }
}
