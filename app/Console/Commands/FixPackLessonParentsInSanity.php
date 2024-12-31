<?php

namespace App\Console\Commands;

use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Models\Content;
use App\Providers\RailcontentURLProvider;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Railroad\Railcontent\Repositories\ContentRepository;

class FixPackLessonParentsInSanity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix-pack-lesson-parents-in-sanity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(SanityGateway $sanityGateway, RailcontentURLProvider $railcontentURLProvider)
    {
        ContentRepository::$bypassPermissions = true;

        Content::query()->where('type', 'pack-bundle-lesson')
            ->where('id', 251517)
            ->chunk(10, function (Collection $contents) use ($sanityGateway, $railcontentURLProvider) {
                /**
                 * @var $contents Content[]|Collection
                 */
                $sanityContents = $sanityGateway->getByRailContentIds($contents->pluck('id')->toArray());

                foreach ($sanityContents as $sanityContent) {
                    /**
                     * @var $rcContent Content
                     */
                    $rcContent = $contents->where('id', $sanityContent['railcontent_id'])->first();

                    $sanityContentParentsDataObject = json_decode($sanityContent['parent_content_data']);
                    $rcContentParentsDataObject = json_decode($rcContent->parent_content_data);

                    if ($sanityContentParentsDataObject[0]->type == 'pack-bundle-lesson') {
                        $this->info('Fixing: ');

                        // first fix the data inside the RC parent column which should never have pack-bundle-lesson
                        foreach ($rcContentParentsDataObject as $rcContentParentDataObjectIndex => $rcContentParentDataObject) {
                            if ($rcContentParentDataObject->type == 'pack-bundle-lesson') {
                                unset($rcContentParentsDataObject[$rcContentParentDataObjectIndex]);

                                $rcContent->parent_content_data = json_encode(
                                    array_values($rcContentParentsDataObject)
                                );
                                $rcContent->save();

                                $contentURLs = $railcontentURLProvider->getContentURLs(
                                    $rcContent->id,
                                    $rcContent->slug,
                                    $rcContent->type
                                );

                                $rcContent->web_url_path = $contentURLs->getWebURLPath();
                                $rcContent->save();

                                $rcContent->refresh();

                                $parentContentDataWithSanityKeys = json_decode($rcContent->parent_content_data);

                                foreach ($parentContentDataWithSanityKeys as $parentContentWithSanityKeysIndex => $parentContentWithSanityKeys) {
                                    $parentContentDataWithSanityKeys[$parentContentWithSanityKeysIndex]->_key = uniqid();
                                }

                                dd($parentContentDataWithSanityKeys);

                                $sanityGateway->patchSetMany([
                                    $sanityContent['sanity_id'] => [
                                        'web_url_path' => $rcContent->web_url_path,
                                        'parent_content_data' => json_decode($rcContent->parent_content_data),
                                    ]
                                ]);

                                $this->info('Sanity Documents patched.');
                            }
                        }
                    }
                }

                dd(1);
            });
    }
}
