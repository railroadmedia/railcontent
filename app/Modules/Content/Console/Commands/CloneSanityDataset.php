<?php

namespace App\Modules\Content\Console\Commands;

use Illuminate\Console\Command;

/**
 * @codeCoverageIgnore - there is no value in testing this class,
 * since it requires integration with Sanity
 */
class CloneSanityDataset extends Command
{
    protected $signature = 'sanity:clone
                            {source=production}
                            {destination=development}';
    protected $description = 'Clone the source dataset into the destination in Sanity';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): int
    {
        $source = $this->argument('source');
        $destination = $this->argument('destination');
        $DATASETS = collect(['production', 'staging', 'development']);
        $hasError = false;
        if ($DATASETS->doesntContain($source)) {
            $this->error(sprintf('Invalid source %s. Must be one of %s', $source, $DATASETS->implode(', ')));
            $hasError = true;
        }
        if ($DATASETS->doesntContain($destination)) {
            $this->error(sprintf('Invalid destination %s. Must be one of %s', $destination, $DATASETS->implode(', ')));
            $hasError = true;
        }
        if ($source == $destination) {
            $this->error('Source and destination must be different');
            $hasError = true;
        }
        if ($destination == 'production') {
            $this->error('Invalid destination. Production is not an option');
            $hasError = true;
        }
        if ($hasError) {
            return self::FAILURE;
        }
        $dbEnvironment = 'staging';
        if($destination == 'development'){
            $dbEnvironment = 'local';
        }
        $scriptPath = '/commands/bash/musora-web-platform/sync-databases-with-prod.sh';
        $command = escapeshellcmd("$scriptPath") . ' ' . escapeshellarg($dbEnvironment) ;
        $output = [];
        $resultCode = null;
        exec($command, $output, $resultCode);
        $this->info(' Command output :: ');
        foreach ($output as $line) {
            $this->info($line); // Output each line
        }
        $this->info(' Start Sanity sync');
        return 1;

        $directory = 'resources/sanitystudio';

        $resultCode = $this->runCliCommand("cd $directory && yarn sanity dataset delete $destination --force");
        if ($resultCode !== self::SUCCESS) {
            $this->error("Failed to delete dataset.");
            return $resultCode;
        }
        $resultCode = $this->runCliCommand("cd $directory && yarn sanity dataset copy $source $destination --skip-history");

        if ($resultCode !== self::SUCCESS) {
            $this->error("Failed to copy dataset.");
            return $resultCode;
        }

        $this->info("Dataset copy from $source to $destination complete.");
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
