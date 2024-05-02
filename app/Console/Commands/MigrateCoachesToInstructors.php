<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class MigrateCoachesToInstructors extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'MigrateCoachesToInstructors';

    protected $signature = 'MigrateCoachesToInstructors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'MigrateCoachesToInstructors';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(DatabaseManager $databaseManager)
    {
        $this->info('Starting MigrateCoachesToInstructors.');
        Log::info('Starting MigrateCoachesToInstructors.');

        $connection = $databaseManager->connection(config('railcontent.database_connection_name'));

        $coachContentRows = $connection->table('railcontent_content')
            ->where('type', 'coach')
            ->where('brand', 'drumeo')
            ->get();

        foreach ($coachContentRows as $coachContentRow) {
            $matchingInstructorContentRows = $connection->table('railcontent_content')
                ->where('type', 'instructor')
                ->where('slug', $coachContentRow->slug)
                ->where('status', 'published')
                ->where('brand', 'drumeo')
                ->get();

            if ($matchingInstructorContentRows->isEmpty() || $matchingInstructorContentRows->count() > 1) {
                $this->info('Too many or not enough matching instructors for coach row. Skipping since its likely an invalid or deleted coach.');
                continue;
            }

            $matchingInstructorContentRow = $matchingInstructorContentRows->first();

            $this->info('Migrating '.$matchingInstructorContentRow->slug);
            Log::info('Migrating '.$matchingInstructorContentRow->slug);

            // update content fields to use instructor ID only
            $connection->table('railcontent_content_fields')
                ->where('value', (string)$coachContentRow->id)
                ->where('key', 'instructor')
                ->update(['value' => (string)$matchingInstructorContentRow->id]);

            // fix railcontent_content_instructors
            $connection->table('railcontent_content_instructors')
                ->where('instructor_id', $coachContentRow->id)
                ->update(['instructor_id' => $matchingInstructorContentRow->id]);

            // set coach content to deleted
            $connection->table('railcontent_content')
                ->where('id', $coachContentRow->id)
                ->update(['status' => 'deleted']);

            // remove all instructor field dupes across all content
            $dupeInstructorFieldsGrouped = $connection->table('railcontent_content_fields')
                ->selectRaw('COUNT(*) as count, content_id, railcontent_content_fields.value')
                ->where('key', 'instructor')
                ->groupBy(['content_id', 'value'])
                ->having('count', '>', 1)
                ->get();

            foreach ($dupeInstructorFieldsGrouped as $dupeInstructorField) {
                $allInstructorFieldsForContentId = $connection->table('railcontent_content_fields')
                    ->where('key', 'instructor')
                    ->where('content_id', $dupeInstructorField->content_id)
                    ->get();

                foreach ($allInstructorFieldsForContentId as $allInstructorFieldForContentId) {
                    if (empty($allInstructorFieldForContentId->value)) {
                        $connection->table('railcontent_content_fields')
                            ->where('id', $allInstructorFieldForContentId->id)
                            ->delete();
                    }

                    if ($allInstructorFieldForContentId->position == 1) {
                        $connection->table('railcontent_content_fields')
                            ->where('key', 'instructor')
                            ->where('content_id', $dupeInstructorField->content_id)
                            ->where('position', '>', 1)
                            ->delete();
                    }
                }
            }

            // remove all instructor link table dupes across all content
            $dupeInstructorLinkRowsGrouped = $connection->table('railcontent_content_instructors')
                ->selectRaw('COUNT(*) as count, content_id, instructor_id')
                ->groupBy(['content_id', 'instructor_id'])
                ->having('count', '>', 1)
                ->orderBy('content_id', 'asc')
                ->chunk(250, function (Collection $dupeInstructorLinkRowsGrouped) use ($connection) {

                    foreach ($dupeInstructorLinkRowsGrouped as $dupeInstructorLinkRowGrouped) {
                        $allInstructorLinkRowsForContentId = $connection->table('railcontent_content_instructors')
                            ->where('content_id', $dupeInstructorLinkRowGrouped->content_id)
                            ->get();

                        $existingInstructorIdsForContent = [];

                        foreach ($allInstructorLinkRowsForContentId as $allInstructorLinkRowForContentId) {
                            if (!isset($existingInstructorIdsForContent[$allInstructorLinkRowForContentId->instructor_id])) {
                                $existingInstructorIdsForContent[$allInstructorLinkRowForContentId->instructor_id] = true;
                            } else {
                                $connection->table('railcontent_content_instructors')
                                    ->where('id', $allInstructorLinkRowForContentId->id)
                                    ->delete();
                            }
                        }
                    }
                });
        }

        $this->info('---------------------------------------------------');
        $this->info('Finished MigrateCoachesToInstructors!');
        Log::info('Finished MigrateCoachesToInstructors!');

        return true;
    }
}
