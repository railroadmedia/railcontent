<?php

namespace App\Modules\Content\Console\Commands;

use Illuminate\Console\Command;

/**
 * @codeCoverageIgnore - there is no value in testing this class,
 * since it requires integration with Sanity
 */
class CopySanityDataset extends Command
{
    protected $signature = 'sanity:copy
                            {source=production}
                            {destination=staging}';
    protected $description = 'Export the source dataset and import it into the destination in Sanity';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): int
    {
        $source = $this->argument('source');
        $destination = $this->argument('destination');
        // dev note: we could do something fancy like run sanity dataset list and check against the results, but
        // we know we have production, staging, and development; so just use that
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
        if ($hasError) {
            return self::FAILURE;
        }
        // export from the source
        // for more information, see https://www.sanity.io/docs/dataset#fd38ca03b011
        $directory = 'resources/sanitystudio';
        $filename = "$source-sanity-export.tar.gz";

        $resultCode = $this->runCliCommand("cd $directory && yarn sanity dataset export $source $filename");
        if ($resultCode !== self::SUCCESS) {
            $this->error("Failed to export $source to $filename. Have you built Sanity Studio using the README instructions?");
            return $resultCode;
        }
        $this->info('Export completed.');

        // import into the destination
        // for more information, see https://www.sanity.io/docs/dataset#9c9aab5198aa
        $resultCode = $this->runCliCommand("cd $directory && yarn sanity dataset import $filename $destination --replace");
        if ($resultCode !== self::SUCCESS) {
            $this->error("Failed to import $filename to $destination. Have you built Sanity Studio using the README instructions?");
            return $resultCode;
        }
        $this->info('Import completed.');

        // clean up the export file
        $resultCode = $this->runCliCommand("rm $directory/$filename");
        if ($resultCode !== self::SUCCESS) {
            $this->error("Failed to delete $filename");
            return $resultCode;
        }
        $this->info('Export file deleted from local storage.');

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
