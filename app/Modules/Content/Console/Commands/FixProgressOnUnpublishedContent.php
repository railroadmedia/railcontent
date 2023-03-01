<?php

namespace App\Modules\Content\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Content\Models\ContentUserProgress;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FixProgressOnUnpublishedContent extends Command
{
    protected $signature = 'content:fixProgressOnUnpublishedContent {--delete}';
    protected $description = 'Removed user progress on unpublished content';

    public function handle()
    {
        $query = DB::table('railcontent_user_content_progress')
            ->select('railcontent_user_content_progress.id')
            ->join(
                'railcontent_content',
                'railcontent_content.id',
                '=',
                'railcontent_user_content_progress.content_id'
            )
            ->where('railcontent_content.published_on', '>', Carbon::now())
            ->orderBy('id', 'desc');
        $count = $query->count();
        $this->info("$count records found.");
        if (!$this->option('delete')) {
            $this->info("Records need to be deleted.  Verify the data to be deleted using this query against the production read database.");
            $this->info("\nSELECT c.slug, parent.slug, c.published_on as parent
                FROM musora_laravel.railcontent_user_content_progress p
                inner join railcontent_content c on p.content_id = c.id
                inner join railcontent_content_hierarchy h on h.child_id = c.id
                inner join railcontent_content parent on parent.id = h.parent_id
                where c.published_on >= now() "
            );
            $this->info("\nRerun the command with --delete to process the delete.");
            return;
        }


        $ids = $query->get();
        $n = 0;
        $ids->each(function ($data) use (&$n) {
            $id = $data->id;
            try {
                ContentUserProgress::query()->find($id)->delete($id);
            } catch (\Throwable $e) {
                $this->info("Unable to delete record $id");
            }
            $n++;
            if ($n % 1000 == 0) {
                $this->info("$n records deleted");
            }
        });
        $this->info("$n records deleted");
    }
}
