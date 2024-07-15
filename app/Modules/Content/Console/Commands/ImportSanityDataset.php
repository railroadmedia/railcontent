<?php

namespace App\Modules\Content\Console\Commands;

use Illuminate\Console\Command;

/**
 * @codeCoverageIgnore - there is no value in testing this class,
 * since it requires integration with Sanity
 */
class ImportSanityDataset extends Command
{
    protected $signature = 'sanity:import
                            {source=production}
                            {destination=staging}';
    protected $description = 'Import dataset into the destination in Sanity from a ndjson file';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): int
    {
        $destination = $this->argument('destination');
        $DATASETS = collect(['production', 'staging', 'development']);
        $hasError = false;
        if ($DATASETS->doesntContain($destination)) {
            $this->error(sprintf('Invalid destination %s. Must be one of %s', $destination, $DATASETS->implode(', ')));
            $hasError = true;
        }
        if ($hasError) {
            return self::FAILURE;
        }

        $directory = 'resources/sanitystudio';
        $filename = "workouts.ndjson";

        // import into the destination
        $resultCode = $this->runCliCommand("cd $directory && yarn sanity dataset import $filename $destination --replace");
        if ($resultCode !== self::SUCCESS) {
            $this->error("Failed to import $filename to $destination. Have you built Sanity Studio using the README instructions?");
            return $resultCode;
        }

        $this->info("Dataset import to $destination complete.");
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
