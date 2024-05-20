<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Events\ContentCreated;

class RepairGuitareoPDFs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "RepairGuitareoPDFs";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Swap PDF tab and PDF tab+notation for the guitareo songs imported in 30.12.2022";


    /**
     * Execute the console command.
     * @return mixed
     */
    public function handle()
    {
        $this->info('#### Starting RepairGuitareoPDFs command #### ');

        $guitareoSongIds = $this->musoraDB()
            ->select('id')
            ->from('railcontent_content')
            ->where("brand", "guitareo")
            ->where("type", "song")
            ->where("created_on", ">", "2022-12-30 00:00:00")
            ->where("created_on", "<", "2022-12-31 00:00:00")
            ->where("slug", "!=", "the-kids-aren-t-alright")  //switch has already been done manually for this song
            ->where("slug", "!=", "three-little-birds")  // the tab pdf is already set correctly; the tab+notation is not working properly
            ->get()
            ->toArray();

        foreach ($guitareoSongIds as $guitareoSongId) {
            $resourceUrls = $this->musoraDB()
                ->from('railcontent_content_data')
                ->where('content_id', $guitareoSongId->id)
                ->where('key', 'resource_url')
                ->get()
                ->toArray()
            ;
            if (count($resourceUrls) == 2) {
                $aux = $resourceUrls[0]->value;
                $resourceUrls[0]->value = $resourceUrls[1]->value;
                $resourceUrls[1]->value = $aux;

                foreach ($resourceUrls as $resourceUrl) {
                    $this->musoraDB()
                        ->from('railcontent_content_data')
                        ->where('id', $resourceUrl->id)
                        ->update(['value' => $resourceUrl->value]);
                }

                event(new ContentCreated($guitareoSongId->id));
            } else {
                $this->info("For content id " . $guitareoSongId->id . " there were not found 2 PDFs.");
            }
        }

        $this->info('#### Command finished #### ');
    }

    private function musoraDB()
    {
        return DB::connection(config('railcontent.database_connection_name'))->query();
    }

}
