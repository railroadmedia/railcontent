<?php

namespace App\Modules\Content\Console\Commands\Data;

use Illuminate\Console\Command;

/**
 * @codeCoverageIgnore - there is no value in testing this class,
 * since it requires integration with Sanity
 */
class ImportSanityLicenses extends Command
{
    protected $signature = 'sanity:import-licenses
                            {input : path of file relative to the "storage" folder }
                            {env=development : staging, production, or development}';
    protected $description = 'Import License Data from TSV';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): int
    {
        $input = $this->argument('input');
        $env = $this->argument('env');
        // dev note: we could do something fancy like run sanity dataset list and check against the results, but
        // we know we have production, staging, and development; so just use that
        $DATASETS = collect(['production', 'staging', 'development']);
        // $hasError = false;
        if ($DATASETS->doesntContain($env)) {
            $this->error(sprintf('Invalid source %s. Must be one of %s', $env, $DATASETS->implode(', ')));
            return self::FAILURE;
        }

        $contentIdIndex = 1;
        $metaDataMap = [

            'mlc' => 2,
            'iswc' => 3,
            'isrc' => 4,
            'song_artist' => 5,
            'song_name' => 6,
        ];
        $publisherMap = [
            'SMP' => 7,
            'UMP' => 8,
            'BMG' => 9,
            'KOBALT' => 10,
            'WCM' => 11,
            'ABKCO' => 13,
            'AUDIAM' => 14,
            'CONCORD' => 15,
            'DMG' => 16,
            'DST' => 17,
            'HIPGNOSIS' => 18,
            'PEER' => 19,
            'RESERVOIR' => 20,
            'ROUND HILL' => 21,
            'SPIRIT' => 22,
            'WIXEN' => 23,
            'OTHER' => 25,
        ];

        $rows = [];
        $firstRow = true;
        $filePath = storage_path($input);
        if (($handle = fopen($filePath, "r")) !== false) {
            while (($data = fgetcsv($handle, 1000, "\t")) !== false) {
                if ($firstRow) {
                    $firstRow = false;
                    continue;
                }
                $mlc = $data[$metaDataMap['mlc']];
                if (!isset($rows[$mlc])) {
                    $rows[$mlc] = [
                        '_id' => 'license_' . strtolower($mlc),
                        '_type' => 'license',
                        'public_domain' => false,
                        'risk' => 'red',
                    ];

                    $rows[$mlc]['content_id'][] = [
                        '_key' => uniqid(),
                        'content_id' => $data[$contentIdIndex]
                    ];

                    foreach ($metaDataMap as $key => $csvIndex) {
                        $rows[$mlc][$key] = $data[$csvIndex];
                    }
                    $rows[$mlc]['license'] = [];
                    foreach ($publisherMap as $publisherName => $CSVIndex) {
                        $publisherPercentage = $data[$CSVIndex] ?? 0;
                        if ($publisherPercentage) {
                            $rows[$mlc]['license'][] = [
                                '_key' => uniqid(),
                                'license_percent' => $publisherPercentage / 100,
                                'publisher' => [
                                    '_ref' => 'publisher_' . preg_replace(
                                            '/[^a-zA-Z0-9_.]/',
                                            '',
                                            strtolower($publisherName)
                                        ),
                                    '_type' => 'reference',
                                ]
                            ];
                        }
                    }
                } else {
                    $rows[$mlc]['content_id'][] = [
                        '_key' => uniqid(),
                        'content_id' => $data[$contentIdIndex]
                    ];
                }
            }
            fclose($handle);
        }

        $directory = 'resources/sanitystudio';
        $fileName = 'licenses.ndjson';
        $ouputFilePath = "$directory/$fileName";
        file_put_contents($ouputFilePath, "");
        foreach ($rows as $result) {
            $newline = json_encode($result) . "\n";
            file_put_contents($ouputFilePath, $newline, FILE_APPEND);
        }
        $resultCode = $this->runCliCommand("cd $directory && yarn sanity dataset import $fileName development --replace");
        if ($resultCode !== self::SUCCESS) {
            $this->error("Failed to import $ouputFilePath. Have you built Sanity Studio using the README instructions?");
            return $resultCode;
        }
        $this->info('import completed.');

        // clean up the export file
        $resultCode = $this->runCliCommand("rm $filePath");
        if ($resultCode !== self::SUCCESS) {
            $this->error("Failed to delete $ouputFilePath");
            return $resultCode;
        }
        $this->info('Export file deleted from local storage.');

        $this->info("Publishers imported.");
        return $resultCode;
    }

    /**
     * Execute the given command in the CLI.
     */
    private function runCliCommand(string $command): int
    {
        $output = null;
        $resultCode = null;

        exec($command, $output, $resultCode);

        foreach ($output as $line) {
            $this->info($line);
        }

        return $resultCode;
    }
}
