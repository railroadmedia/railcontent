<?php

namespace App\Modules\Content\Console\Commands\Data;

use Illuminate\Console\Command;

/**
 * @codeCoverageIgnore - there is no value in testing this class,
 * since it requires integration with Sanity
 */
class ImportSanityPublishers extends Command
{
    protected $signature = 'sanity:import-publishers
                            {input : path of file relative to the "storage" folder }
                            {env=development : staging, production, or development}';
    protected $description = 'Import Publisher Data from CSV';


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

        $rows = [];
        $firstRow = true;
        $filePath = storage_path($input);
        if (($handle = fopen($filePath, "r")) !== false) {
            while (($data = fgetcsv($handle, 1000, "\t")) !== false) {
                if ($firstRow) {
                    $firstRow = false;
                    continue;
                }

                $child = $data[0];
                $name = $data[1];
                foreach ($rows as &$entries) {
                    if ($entries['name'] == $name) {
                        $entries['child'][] = $child;
                        $name = null;
                        $child = null;
                    }
                }

                if ($name != null) {
                    $length = count($rows);
                    $rows[$length + 1]['name'] = $name;
                    $rows[$length + 1]['child'] = [];
                    $rows[$length + 1]['child'][] = $child;
                }
            }
            fclose($handle);
        }

        $publishers = [];
        foreach ($rows as $parent => $child) {
            $name =  preg_replace('/[^a-zA-Z0-9_.]/', '', $child['name']);

            $id = 'publisher_' . strtolower($name);
            $publishers[$id] = [
                '_id' => $id,
                'name' => $child['name'],
                '_type' => 'publisher',
                'child' => collect($child['child'])->map(function ($child) {
                    return [
                        '_key' => uniqid(),
                        'name' => $child
                    ];
                }),
            ];
        }

        $directory = resource_path('sanitystudio');
        $fileName = 'publishers.ndjson';
        $outputFilePath = "$directory/$fileName";
        file_put_contents($outputFilePath, "");
        foreach ($publishers as $publisher) {
            $newline = json_encode($publisher) . "\n";
            file_put_contents($outputFilePath, $newline, FILE_APPEND);
        }

        //note: for future use, "staging" here should be $env, and fix the env check
        $resultCode = $this->runCliCommand("cd $directory && yarn sanity dataset import $fileName $env --replace");
        if ($resultCode !== self::SUCCESS) {
            $this->error("Failed to import $outputFilePath. Have you built Sanity Studio using the README instructions?");
            return $resultCode;
        }
        $this->info('import completed.');

        // clean up the export file
        $resultCode = $this->runCliCommand("rm $filePath");
        if ($resultCode !== self::SUCCESS) {
            $this->error("Failed to delete $outputFilePath");
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
