<?php

namespace App\Console\Commands;

use App\Maps\ContentTypes;
use App\Modules\Brand\Enums\Brand;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SeedLiveAndScheduledContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SeedLiveAndScheduledContent {--live-now}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Schedules upcoming live and scheduled content. Optionally set an event to be live right now.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dbConnection = DB::connection(config('railcontent.database_connection_name'));

        foreach (Brand::cases() as $brandEnum) {
            $brandString = $brandEnum->value;

            $contentRows = $dbConnection->table('railcontent_content')
                ->whereIn('type', ContentTypes::liveContentTypes())
                ->where('brand', $brandString)
                ->where('status', 'published')
                ->where('published_on', '<', Carbon::now()->toDateTimeString())
                ->orderBy('published_on', 'desc')
                ->limit(50)
                ->get();

            $contentRowsToReset = $dbConnection->table('railcontent_content')
                ->whereIn('type', ContentTypes::liveContentTypes())
                ->where('brand', $brandString)
                ->where('status', 'scheduled')
                ->whereBetween(
                    'published_on',
                    [Carbon::now()->subDay()->toDateTimeString(), Carbon::now()->addDay()->toDateTimeString()]
                )
                ->update(
                    [
                        'status' => 'published',
                        'published_on' => Carbon::now()->addDays(rand(1, 100))->toDateTimeString(),
                    ]
                );

            $liveNowSet = false;

            foreach ($contentRows as $contentRowIndex => $contentRow) {
                // set up as if it's an upcoming live stream (scheduled)
                if (in_array($contentRow->type, ContentTypes::liveContentTypes())) {
                    if (!$liveNowSet &&
                        $this->option('live-now')) {
                        $liveStart = Carbon::now()->subMinutes(rand(1, 15));
                        $liveNowSet = true;
                    } else {
                        $liveStart =
                            Carbon::now()->addDays(rand(1, 50))->addHours(rand(0, 24))->addMinutes(rand(0, 1000));
                    }

                    $dbConnection->table('railcontent_content')
                        ->where('id', $contentRow->id)
                        ->update([
                            'published_on' => $liveStart->toDateTimeString(),
                            'status' => 'scheduled',
                            'live_event_start_time' => $liveStart->toDateTimeString(),
                            'live_event_end_time' => $liveStart->copy()->addHour()->toDateTimeString(),
                        ]);

                    $dbConnection->table('railcontent_content_fields')
                        ->updateOrInsert([
                            'content_id' => $contentRow->id,
                            'key' => 'live_event_start_time',
                            'position' => 1,
                        ], [
                            'value' => $liveStart->toDateTimeString(),
                            'type' => 'datetime',
                        ]);

                    $dbConnection->table('railcontent_content_fields')
                        ->updateOrInsert([
                            'content_id' => $contentRow->id,
                            'key' => 'live_event_end_time',
                            'position' => 1,
                        ], [
                            'value' => $liveStart->copy()->addHour()->toDateTimeString(),
                            'type' => 'datetime',
                        ]);
                }
            }

            $this->info('Done!');
        }

        return 0;
    }
}
