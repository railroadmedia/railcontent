<?php

namespace App\Modules\Content\Console\Commands;

use App\Modules\Content\Jobs\ImportSongDurationFromSoundslice;
use App\Modules\Content\Models\Content;
use Carbon\Carbon;
use Illuminate\Bus\Batch;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;

class SongDuration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SongDuration {brand=drumeo}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate SongDuration using SoundSlice API';

    /**
     * @return false|void
     * @throws \Throwable
     */
    public function handle()
    {
        $start = microtime(true);
        $brand = $this->argument('brand');
        Log::info("Processing SongDuration command in order to get song duration from Soundslice API");
        $query =
            Content::query()
                ->whereHas('contentHierarchy.child', function (Builder $query) {
                    $query->whereNotNull('soundslice_slug')->whereNot('soundslice_slug', '=', '');
                })
                ->where('railcontent_content.status', '!=', "deleted")
                ->where('railcontent_content.status', '!=', "draft")
                ->where('railcontent_content.brand', '=', $brand)
                ->whereNotExists(function ($query) {
                    $query->select(\DB::raw(1))
                        ->from('railcontent_content_fields')
                        ->whereRaw('railcontent_content_fields.content_id = railcontent_content.id and railcontent_content_fields.key="length_in_seconds"');
                })
            ->where('railcontent_content.type', '=', 'song')
            ->with('contentHierarchy.child');

        $queryCount = $query->count();

        if ($queryCount === 0) {
            Log::info("There are no items to be updated!");
            return false;
        }

        Log::info('Checking '.$queryCount.' items...');
        $batchSize = 50;
        $songs = $query->orderBy('railcontent_content.id', 'desc');
        $jobs = [];
        $songs->chunk($batchSize, function ($song) use (&$jobs, $brand) {
            $firstSongId = $song->first()->id;
            $lastSongId = $song->last()->id;
            $jobs[] = new ImportSongDurationFromSoundslice($firstSongId, $lastSongId, $brand);
        });

        $this->info(count($jobs).' jobs ...');
        $startAt = Carbon::now();
        $batch = Bus::batch($jobs)
            ->then(function (Batch $batch) use ($startAt) {
                Log::info(sprintf("ImportSongDurationFromSoundslice: completed in %s seconds", $startAt->diffInSeconds()));
            })->catch(function (Batch $batch, Throwable $e) {
                Log::error($e->getMessage());
            })
            ->onQueue('command')
            ->dispatch();

        $finish = microtime(true) - $start;
        $format = "Finished Soundslice songs duration migration(%s) in total %s seconds\n ";
        Log::info(sprintf($format, $queryCount, $finish));
    }

}
