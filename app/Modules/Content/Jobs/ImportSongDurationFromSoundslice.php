<?php

namespace App\Modules\Content\Jobs;

use App\Modules\Content\Models\Content;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\LogsShopify;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Railroad\Railcontent\Services\ContentFieldService;
use Railroad\Railcontent\Services\ContentService;

class ImportSongDurationFromSoundslice implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    use LogsShopify;


    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 840;
    protected array $results = [];


    /**
     * Create a new job instance.
     */
    public function __construct(
        protected int $startAtId,
        protected int $endAtId,
        protected string $brand
    ) {
    }

    public function handle(
        ContentFieldService $contentFieldService
    ): void {
        $this->logDebug(
            sprintf("%s: running batch for %s songs %s - %s", $this->getClassName(), $this->brand, $this->startAtId, $this->endAtId)
        );
        $batchSize = 25;

        $query =
            Content::query()
                ->whereBetween("railcontent_content.id", [$this->endAtId, $this->startAtId])
                ->whereHas('contentHierarchy.child', function (Builder $query) {
                    $query->whereNotNull('soundslice_slug')->whereNot('soundslice_slug', '=', '');
                })
                ->where('railcontent_content.status', '!=', "deleted")
                ->where('railcontent_content.status', '!=', "draft")
                ->where('railcontent_content.brand', '=', $this->brand)
                ->whereNotExists(function ($query) {
                    $query->select(\DB::raw(1))
                        ->from('railcontent_content_fields')
                        ->whereRaw('railcontent_content_fields.content_id = railcontent_content.id and railcontent_content_fields.key="length_in_seconds"');
                })
                ->where('railcontent_content.type', '=', 'song')
                ->with('contentHierarchy.child');
        $query->orderBy('railcontent_content.id', 'desc')
            ->chunk($batchSize, function ($items) use ($contentFieldService) {
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
                                    $contentFieldService->create(
                                        $item->id,
                                        'length_in_seconds',
                                        round($duration),
                                        1,
                                        'integer'
                                    );

                                    $item->length_in_seconds = null;
                                    $item->save();
                                    // Log::info('Updated slug: '.$slug.' duration: '.$duration.'  item id:'.$item->id. '    item type:'.$item->type);
                                }
                            } else {
                                Log::info('empty body for slug '.$slug);
                                continue;
                            }
                        }
                    } catch (\Exception $e) {
                        if($e->getCode() == 429) {
                            Log::info('Too Many Requests, sleep for 60 s');
                            sleep(60);
                            $this->batch()->add(
                                new ImportSongDurationFromSoundslice(
                                    $item->id,
                                    $this->startAtId,
                                    $this->brand
                                )
                            );
                        }
                        // Log::info('can not update for slug: '.$slug .'  item id:'.$item->id. '    item type:'.$item->type.' error::: '.$e->getMessage());
                    }
                }
            });
    }

    /**
     * @inheritDoc
     */
    protected function getClassName(): string
    {
        return "ImportSongDurationFromSoundslice";
    }
}
