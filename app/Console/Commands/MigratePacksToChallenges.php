<?php

namespace App\Console\Commands;

use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\ContentHierarchy;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Services\ContentService;

class MigratePacksToChallenges extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MigratePacksToChallenges';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate specified packs to challenges, restructure the hierarchy, and update compiled view data.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(ContentService $contentService)
    {
        $packChallengeIds = [
            367385, // Special handling: Update slug to "30-day-drummer-season-1"
            383627,
            394326,
            412811,
            413340,
        ];

        $updatedChallenges = [];
        $updatedChallengeParts = [];

        DB::transaction(function () use ($packChallengeIds, &$updatedChallenges, &$updatedChallengeParts) {
            foreach ($packChallengeIds as $packChallengeId) {
                // Check if the migration has already been performed
                $pack = Content::find($packChallengeId);

                if (!$pack) {
                    $this->error("Pack with ID $packChallengeId not found.");
                    continue;
                }

                if ($pack->type === 'challenge') {
                    $this->info(
                        "Pack ID $packChallengeId has already been migrated to a challenge. Skipping database updates."
                    );
                    $updatedChallenges[] = $pack->id;
                    $updatedChallengeParts = array_merge($updatedChallengeParts, $this->getChildIds($pack->id));
                    continue;
                }

                // Special handling for pack ID 367385
                if ($packChallengeId === 367385) {
                    $pack->slug = '30-day-drummer-season-1';
                }

                // Update the pack to "challenge"
                $pack->type = 'challenge';
                $pack->save();
                $updatedChallenges[] = $pack->id;

                // Get pack-bundles under this pack
                $packBundles = ContentHierarchy::query()->where('parent_id', $pack->id)->get();

                $lessons = collect();

                foreach ($packBundles as $bundle) {
                    // Get lessons under the pack-bundle
                    $bundleLessons = ContentHierarchy::query()->where('parent_id', $bundle->child_id)->get();

                    // Collect lessons for later processing
                    $lessons = $lessons->merge($bundleLessons);

                    // Delete the pack-bundle hierarchy
                    $bundle->delete();
                }

                // Reorganize lessons under the pack (now a challenge)
                $sortedLessons = $lessons->sortBy(function ($lesson) {
                    return Content::find($lesson->child_id)->published_on ?? now();
                });

                $childPosition = 1;
                foreach ($sortedLessons as $lesson) {
                    ContentHierarchy::create([
                        'parent_id' => $pack->id,
                        'child_id' => $lesson->child_id,
                        'child_position' => $childPosition++, // Increment for each lesson
                        'created_on' => now(),
                    ]);

                    $updatedChallengeParts[] = $lesson->child_id;

                    // Delete the old hierarchy entry for the lesson
                    $lesson->delete();
                }

                $this->info("Pack ID $packChallengeId migrated successfully.");
            }
        });

        // Run the ContentService for updated challenges and challenge parts
        $this->info("Updating compiled view data for challenges and challenge parts...");
        $allContentIds = array_merge($updatedChallenges, $updatedChallengeParts);
        $contentService->fillCompiledViewContentDataColumnForContentIds($allContentIds);

        $this->info("Updated compiled view data for content IDs.");

        $this->info('Migration and compiled view data updates are complete.');

        return Command::SUCCESS;
    }

    /**
     * Get all child IDs for a given content ID.
     *
     * @param int $parentId
     * @return array
     */
    private function getChildIds(int $parentId): array
    {
        return ContentHierarchy::query()
            ->where('parent_id', $parentId)
            ->pluck('child_id')
            ->toArray();
    }
}
