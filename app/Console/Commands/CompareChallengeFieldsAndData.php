<?php

namespace App\Console\Commands;

use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\ContentField;
use App\Modules\Content\Models\ContentData;
use Illuminate\Console\Command;

class CompareChallengeFieldsAndData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CompareChallengeFieldsAndData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compare fields and data of migrated challenges against a reference challenge.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $referenceChallengeId = 402199; // Reference challenge ID
        $migratedChallengeIds = [
            367385,
            383627,
            394326,
            412811,
            413340,
        ];

        // Fetch reference fields and data
        $referenceFields = ContentField::query()
            ->where('content_id', $referenceChallengeId)
            ->get()
            ->keyBy('key');
        $referenceData = ContentData::query()
            ->where('content_id', $referenceChallengeId)
            ->get()
            ->keyBy('key');

        $this->info("Reference Challenge ID $referenceChallengeId Fields and Data:");
        $this->line("Fields: " . json_encode($referenceFields->toArray(), JSON_PRETTY_PRINT));
        $this->line("Data: " . json_encode($referenceData->toArray(), JSON_PRETTY_PRINT));

        foreach ($migratedChallengeIds as $challengeId) {
            $this->info("\nChecking Migrated Challenge ID $challengeId...");

            $challengeFields = ContentField::query()
                ->where('content_id', $challengeId)
                ->get()
                ->keyBy('key');
            $challengeData = ContentData::query()
                ->where('content_id', $challengeId)
                ->get()
                ->keyBy('key');

            // Compare fields
            $missingFields = $referenceFields->diffKeys($challengeFields);
            if ($missingFields->isNotEmpty()) {
                $this->warn("Missing Fields:");
                foreach ($missingFields as $key => $field) {
                    $this->line(" - Key: $key, Type: {$field['type']}, Value: {$field['value']}");
                }
            } else {
                $this->info("No fields are missing.");
            }

            // Compare data
            $missingData = $referenceData->diffKeys($challengeData);
            if ($missingData->isNotEmpty()) {
                $this->warn("Missing Data:");
                foreach ($missingData as $key => $data) {
                    $this->line(" - Key: $key, Value: {$data['value']}");
                }
            } else {
                $this->info("No data is missing.");
            }
        }

        $this->info("Comparison complete.");

        return Command::SUCCESS;
    }
}
