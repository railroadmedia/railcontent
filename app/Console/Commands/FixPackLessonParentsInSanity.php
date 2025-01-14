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

        $total = Content::query()->where('type', 'pack-bundle-lesson')->count();
        $count = 0;

        Content::query()->where('type', 'pack-bundle-lesson')
//            ->where('id', 251517)
            ->chunk(50, function (Collection $contents) use ($sanityGateway, $railcontentURLProvider, $total, &$count) {
                /**
                 * @var $contents Content[]|Collection
                 */
                $sanityContents = $sanityGateway->getByRailContentIds($contents->pluck('id')->toArray());

                $this->info('Fixing IDs: ');
                $this->info(implode(', ', $contents->pluck('id')->toArray()));

                $sanityPatchData = [];

                foreach ($sanityContents as $sanityContent) {
                    $count++;

                    /**
                     * @var $rcContent Content
                     */
                    $rcContent = $contents->where('id', $sanityContent['railcontent_id'])->first();

                    if (empty($rcContent) || $sanityContent['type'] != 'pack-bundle-lesson') {
                        continue;
                    }

                    $sanityContentParentsDataObject = json_decode($sanityContent['parent_content_data']);
                    $rcContentParentsDataObject = json_decode($rcContent->parent_content_data);

                    if (empty($sanityContentParentsDataObject[0])) {
                        $this->info('Parent data not set on: ' . $sanityContent['railcontent_id']);
                    }

                    if (!empty($sanityContentParentsDataObject[0]) &&
                        $sanityContentParentsDataObject[0]->type == 'pack-bundle-lesson') {
                        // first fix the data inside the RC parent column which should never have pack-bundle-lesson
                        foreach ($rcContentParentsDataObject as $rcContentParentDataObjectIndex => $rcContentParentDataObject) {
                            if ($rcContentParentDataObject->type == 'pack-bundle-lesson') {
                                unset($rcContentParentsDataObject[$rcContentParentDataObjectIndex]);
                            }
                        }

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

                        $sanityPatchData[$sanityContent['sanity_id']] = [
                            'web_url_path' => $rcContent->web_url_path,
                            'parent_content_data' => $parentContentDataWithSanityKeys,
                        ];
                    }
                }

                if (!empty($sanityPatchData)) {
                    $sanityGateway->patchSetMany($sanityPatchData);

                    $this->info('Patched Sanity.');
                }


                $this->info('Done ' . $count . ' out of ' . $total);
            });
    }
}
