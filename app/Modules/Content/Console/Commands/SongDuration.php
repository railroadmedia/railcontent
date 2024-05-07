<?php

namespace App\Modules\Content\Console\Commands;

use App\Modules\Content\Builders\ContentBuilder;
use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\ContentField;
use App\Modules\Content\Models\UserPlaylist;
use App\Modules\Content\Models\UserPlaylistContent;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SongDuration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SongDuration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate SongDuration';

    private DatabaseManager $databaseManager;

    private $auth;

    /**
     * @param DatabaseManager $databaseManager
     */
    public function __construct(
        DatabaseManager $databaseManager
    ) {
        parent::__construct();

        $this->databaseManager = $databaseManager;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $start = microtime(true);

        //        $query =
        //            ContentField::query()
        //                ->where('key', 'soundslice_slug')
        //                ->whereNotNull('value')
        //                ->whereHas(
        //                           'content' , function (ContentBuilder $query) {
        //                               $query->where('status', '!=', "deleted")
        //                                   ->where('status', '!=', "draft")
        //                               ->whereNull('length_in_seconds');
        //                           },
        //                       );

        $query =
            Content::query()
                ->join('railcontent_content_hierarchy as hierarchy', 'hierarchy.parent_id', '=', 'railcontent_content.id')
                ->join('railcontent_content_fields as f', 'f.content_id', '=', 'hierarchy.child_id')
                ->join('railcontent_content as soundslice', 'soundslice.id', '=', 'hierarchy.child_id')
               // ->where('key', 'soundslice_slug')
               // ->whereNotNull('soundslice.soundslice_slug')
                   ->where(
                       'f.key',
                       '=',
                       'soundslice_slug'
                   )
                ->where('railcontent_content.status', '!=', "deleted")
                ->where('railcontent_content.status', '!=', "draft")
                ->where('railcontent_content.brand', '=', 'drumeo')
                //->whereNull('soundslice.length_in_seconds')
                ->where('soundslice.length_in_seconds', '=', 0)
            ->where('railcontent_content.type', '=', 'song')
//            ->whereIn('railcontent_content.id', ['380116','380118','380120','380122','380124',
//                '380126','380128','380130','380132','380134','380136','380138','380140',
//                '380142','380144','380146','380148','380150','380152','380154','380156','380158','380160'
//                ,'380162','380164','380166','380168','380170','380172','380174','380176','380178','380180','380182'
//                ,'380184','380186','380188','380190','380192','380194'
//                ,'380196','380198','380202'
//            ])
        ;
        //                ->whereHas(
        //                    'content' , function (ContentBuilder $query) {
        //                    $query->where('status', '!=', "deleted")
        //                        ->where('status', '!=', "draft")
        //                        ->whereNull('length_in_seconds');
        //                },
        //                );

        $queryCount = $query->count();

        if ($queryCount === 0) {
            $this->warn('There are no items to be updated!');

            return false;
        }

        $this->info('Updating items...');
        $this->newLine();
        $bar = $this->output->createProgressBar($queryCount);
        $bar->start();

        $client = new \GuzzleHttp\Client();

        $this->auth = [env('SOUNDSLICE_APP_ID'), env('SOUNDSLICE_SECRET')];

        // chunk or chunkById
        $query->orderBy('railcontent_content.id', 'desc')
            ->chunk(50, function ($items) use ($bar) {
                $client = new \GuzzleHttp\Client();

                $auth = [env('SOUNDSLICE_APP_ID'), env('SOUNDSLICE_SECRET')];
                //                $response = $client->request('GET', 'https://www.soundslice.com/'.'api/v1/slices/'.'SQw4c'.'/recordings', [
                //                    'auth' => $auth,
                //                ]);
                //                $body = json_decode($response->getBody(), true);
                //
                //                dd($body);
                foreach ($items as $item) {
                    $slug = $item['soundslice_slug'];

                    try {
                        if(!in_array($slug, ['376Dc', 'gw4fc','229562','225905','228109','225924','225214','229629','227923','227894','225196',
                            '226202','225189','226189','225186','223969','226196','227187','232263','229618','229610','169790','227091',
                            '231947','223960','232232','223896','231972','223713','','231956','232226','225940','229565','162465','229557','221321','229550',
                            '202321','200747','182346','173091','169227','162136','162463','161933','162471','162473','162475','162480','176791',
                            '162623','162624','169162','227104','162635','162892'])) {
                            $response = $client->request('GET', 'https://www.soundslice.com/'.'api/v1/slices/'.$slug.'/recordings', [
                                'auth' => $auth,
                            ]);
                            $body = json_decode($response->getBody(), true);

                            if (!empty($body)) {
                                $duration = \Arr::last($body)['cropped_duration'] ?? \Arr::first($body)['cropped_duration'] ?? 0;

                                if($duration > 0) {
                                    $item->length_in_seconds = $duration;
                                    $item->save();
                                    $this->info('slug: '.$slug.' duration: '.$duration);
                                }
                            } else {
                                $this->info('empty body pt slug '.$slug);
                                continue;
                            }
                        }
                        $bar->advance();
                    } catch (\Exception $e) {
                        dd($e);
                    }


                }
                sleep(120);
            });

        $bar->finish();

        $this->newLine(2);
        $this->info('Soundslice songs have been sucessfully updated!');

        $finish = microtime(true) - $start;
        $format = "Finished data migration(%s) in total %s seconds\n ";
        $this->info(sprintf($format, $queryCount, $finish));
    }

}
