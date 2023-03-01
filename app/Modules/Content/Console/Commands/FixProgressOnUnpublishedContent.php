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
        $query = DB::table('railcontent_user_content_progress as p')
            ->join('railcontent_content as c', 'c.id', '=', 'p.content_id')
            ->join('railcontent_content_hierarchy as h', 'h.child_id', '=', 'c.id')
            ->join('railcontent_content as pc', 'pc.id', '=', 'h.parent_id')
            ->where('c.published_on', '>', Carbon::now());
        $count = $query->count();
        $this->info("$count records found.");

        if (!$this->option('delete')) {
            $contents = $query->select(['c.slug', 'pc.slug as parentslug'])->distinct()->get();
            $this->info("Records need to be deleted.  Verify the user progress data to be deleted.");
            $this->info("Data includes the following slugs:");
            foreach($contents as $content){
                $this->info("$content->slug parent:$content->parentslug");
            }
            $this->info("\nRerun the command with --delete to process the delete.");
            return;
        }


        $ids = $query->select('p.id')->get();
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
