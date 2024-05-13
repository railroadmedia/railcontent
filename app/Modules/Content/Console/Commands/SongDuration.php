<?php

namespace App\Modules\Content\Console\Commands;

use App\Modules\Content\Models\Content;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Builder;
use Railroad\Railcontent\Services\ContentService;

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
    public function handle(ContentService $contentService)
    {
        $start = microtime(true);

        $query =
            Content::query()
                ->whereHas('contentHierarchy.child', function (Builder $query) {
                    $query->whereNotNull('soundslice_slug')->whereNot('soundslice_slug', '=', '');
                })
                ->where('railcontent_content.status', '!=', "deleted")
                ->where('railcontent_content.status', '!=', "draft")
                ->where('railcontent_content.brand', '=', 'pianote')
                ->whereNotExists(function ($query) {
                    $query->select(\DB::raw(1))
                        ->from('railcontent_content_fields')
                        ->whereRaw('railcontent_content_fields.content_id = railcontent_content.id and railcontent_content_fields.key="length_in_seconds"');
                })
            ->where('railcontent_content.type', '=', 'song')
            ->with('contentHierarchy.child');

        $queryCount = $query->count();

        if ($queryCount === 0) {
            $this->warn('There are no items to be updated!');

            return false;
        }

        $this->info('Updating items...');
        $this->newLine();
        $bar = $this->output->createProgressBar($queryCount);
        $bar->start();

        $query->orderBy('railcontent_content.id', 'desc')
            ->chunk(50, function ($items) use ($bar, $contentService) {
                $client = new \GuzzleHttp\Client();
                $auth = [env('SOUNDSLICE_APP_ID'), env('SOUNDSLICE_SECRET')];
                foreach ($items as $item) {
                    $slug = $item->contentHierarchy->child->soundslice_slug;

                    try {
                        if($slug != '') {
                            $response = $client->request('GET', 'https://www.soundslice.com/'.'api/v1/slices/'.$slug.'/recordings', [
                                'auth' => $auth,
                            ]);
                            $body = json_decode($response->getBody(), true);

                            if (!empty($body)) {
                                $duration = \Arr::last($body)['cropped_duration'] ?? \Arr::first($body)['cropped_duration'] ?? 0;

                                if($duration > 0) {
                                    $item->setLengthInSeconds(round($duration));
                                    $item->length_in_seconds = null;
                                    $item->save();
                                    $contentService->fillCompiledViewContentDataColumnForContentIds([$item->id]);
                                    $this->info('slug: '.$slug.' duration: '.$duration.'  item id:'.$item->id. '    item type:'.$item->type);
                                }
                            } else {
                                $this->warn('empty body pt slug '.$slug);
                                continue;
                            }
                        }
                        $bar->advance();
                    } catch (\Exception $e) {
                        $this->warn('can not update for slug: '.$slug .'  item id:'.$item->id. '    item type:'.$item->type.' error::: '.$e->getMessage());
                    }


                }
                sleep(20);
            });

        $bar->finish();

        $this->newLine(2);
        $this->info('Soundslice songs have been sucessfully updated!');

        $finish = microtime(true) - $start;
        $format = "Finished data migration(%s) in total %s seconds\n ";
        $this->info(sprintf($format, $queryCount, $finish));
    }

}
