<?php

namespace App\Modules\Content\Console\Commands\Data;

use App\Modules\Content\ApiGateways\SanityGateway;
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

        $publicOwnedIndex = 0;
        $contentIdIndex = 1;
        $metaDataMap = [

            'mlc' => 2,
            'isrc' => 3,
            'iswc' => 4,
            'song_name' => 5,
            'song_artist' => 6,
        ];
        $publisherMap = [
            'SMP' => 7,
            'UMP' => 8,
            'BMG' => 9,
            'KOBALT' => 10,
            'WCM' => 11,
            'ABKCO' => 12,
            'AUDIAM' => 13,
            'BELIEVE' => 14,
            'CONCORD' => 15,
            'DMG' => 16,
            'DST' => 17,
            'HAL' => 18,
            'HIPGNOSIS' => 19,
            'PEER' => 20,
            'RESERVOIR' => 21,
            'ROUND HILL' => 22,
            'SPIRIT' => 23,
            'WIXEN' => 24,
            'OTHER' => 25,
        ];
        $riskIndex = 26;
        $nullMLCCount = 0;

        $rows = []; //storage variable for creating licence json array
        $firstRow = true;
        $filePath = storage_path($input);
        if (($handle = fopen($filePath, "r")) !== false) {
            //first, run through whole file to grab all content ids
            $idsArray = [];
            while (($data = fgetcsv($handle, 1000, "\t")) !== false) {
                if ($firstRow) {
                    $firstRow = false;
                    continue;
                }
                if ($data[$contentIdIndex] != ""){ $idsArray[] = $data[$contentIdIndex]; } //get all content id's
            }
            //AFTER running through all file ids, create string and query sanity for all matching ids. have to batch query
            $uniqArray = array_unique($idsArray);
            $idQueryLength = count($uniqArray);
            $batchSize = 1000;
            $batches = ceil($idQueryLength/$batchSize);
            $sanityGateway = app()->make(SanityGateway::class);
            $documents = [];
            for ($i = 0; $i < $batches; $i++) {
                $idsString = implode(',', array_slice($uniqArray, $i * $batchSize, $batchSize));
                $query = "*[railcontent_id in [$idsString] ]{
                    _id,
                    railcontent_id,
                    }";
                $response = $sanityGateway->sanity->fetch($query);
                $documents = array_merge($documents, $response);
            }
            //now run through tsv again, line by line, sorting licence info into json array, for import into sanity
            rewind($handle);
            $firstRow = true;
            while (($data = fgetcsv($handle, 1000, "\t")) !== false) {
                if ($firstRow) {
                    $firstRow = false;
                    continue;
                }
                $mlc = trim($data[$metaDataMap['mlc']]);    //trim removes accidental whitespaces


                /* BEH-204 (Feb 2 2025)
                 * this is for licences that have a content attached but no MLC, since the logic here sorts by mlc.
                 * With the current licence import, there are 54 of such licences
                 * i guess let's include em
                 * ¯\_(ツ)_/¯ */
                if ($mlc === "") {
                    $mlc = "nul$nullMLCCount";
                    $nullMLCCount++;
                }
                //if there's no existing entry with this mlc, create all the sub-information for it, except licence
                if (!isset($rows[$mlc])) {
                    $rows[$mlc] = [
                        '_id' => 'license_' . strtolower($mlc),
                        '_type' => 'license',
                        'public_domain' => ($data[$publicOwnedIndex] != "" ? filter_var($data[$publicOwnedIndex], FILTER_VALIDATE_BOOLEAN) : null),
                        'risk' => ($data[$riskIndex] != "" ? strtolower($data[$riskIndex]) : null),
                    ];
                    //compare current content_id with all queried song ids. set reference if found.
                    foreach ($documents as $document) {
                        if ($document['railcontent_id'] == $data[$contentIdIndex]) {
                            $rows[$mlc]['content'][] = [
                                '_ref' => $document['_id'],
                                '_type' => 'reference',
                                '_weak' => false,
                            ];
                            break;
                        }
                    }
                    //add all metadata like mlc etc
                    foreach ($metaDataMap as $key => $csvIndex) {
                        $rows[$mlc][$key] = $data[$csvIndex];
                    }
                    //add licence references
                    $rows[$mlc]['license'] = [];
                    foreach ($publisherMap as $publisherName => $CSVIndex) {
                        $publisherPercentage = $data[$CSVIndex] ?? 0;   //run through for each publisher, and add their licence and percentage if exists
                        if ($publisherPercentage) {
                            $rows[$mlc]['license'][] = [
                                '_key' => uniqid(),
                                'license_percent' => floatval($publisherPercentage),
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
                } else {    //if there already exists an entry with matching mlc, jus set additional content ref
                    foreach ($documents as $document) {
                        if ($document['railcontent_id'] == $data[$contentIdIndex]) {
                            $rows[$mlc]['content'][] = [
                                '_ref' => $document['_id'],
                                '_type' => 'reference',
                                '_weak' => false,

                            ];
                            break;
                        }
                    }
                }
            }
            fclose($handle);
        }

        $directory = resource_path('sanitystudio');
        $fileName = 'licenses.ndjson';
        $ouputFilePath = "$directory/$fileName";
        file_put_contents($ouputFilePath, "");
        foreach ($rows as $result) {
            $newline = json_encode($result) . "\n";
            file_put_contents($ouputFilePath, $newline, FILE_APPEND);
        }
        $resultCode = $this->runCliCommand("cd $directory && yarn sanity dataset import $fileName $env --replace");
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
