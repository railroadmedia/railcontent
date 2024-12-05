<?php

namespace App\Modules\Content\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Models\Content;
use Carbon\Carbon;
use Exception;
use Railroad\Railcontent\Events\ContentCreated;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\RailcontentV2DataSyncingService;

class ChallengesV2UpdateWebUrlPath extends Command
{
    protected $name = 'ChallengesV2UpdateWebUrlPath';
    protected $signature = 'challenges:update-urls';
    protected $description = 'Update web url path for all challenge and challenge part content';

    public function handle(
        ContentService $contentService,
        RailcontentV2DataSyncingService $dataSyncingService,
        SanityGateway $sanityGateway,
    ): void {
        ContentRepository::$bypassPermissions = true;
        $challenges = $contentService->getAllByType('challenge');
        $challengeParts = $contentService->getAllByType('challenge-part');
        $challengeIds = $challenges->pluck('id')->toArray();
        $challengePartIds = $challengeParts->pluck('id')->toArray();
        //We do challenges first because they need to be updated for the parent-content field to be correct for the childrens
        $dataSyncingService->syncContentIds($challengeIds);
        $this->info('challenges synced');
        $dataSyncingService->syncContentIds($challengePartIds);
        $this->info('challenge parts synced');

        $allContentIds = [... $challengeIds, ... $challengePartIds];
        $allContents = $contentService->getByIds([...$challengeIds, ...$challengePartIds]);
        $sanityDocuments = $sanityGateway->getByRailContentIds($allContentIds);
        $missingContents = [];
        foreach($allContents as $content) {
            $found = false;
            foreach($sanityDocuments as $sanityDocument) {
                if ($sanityDocument['id'] == $content['id'] ) {
                    $found = true;
                    break;
                }
            }
            if ($found) {
                $id = $content['type'] . '_' . $content['id'];
                $patches[$id] = [
                    'web_url_path' => $content['web_url_path'],
                ];
            } else {
                $missingContents[] = $content;
            }
        }
        $sanityGateway->patchSetMany($patches);;
        $this->info('Processed All Challenge and Challenge Parts for web_url_path');
    }
}
