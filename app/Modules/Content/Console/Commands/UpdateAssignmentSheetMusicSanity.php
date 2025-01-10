<?php

namespace App\Modules\Content\Console\Commands;

use App\Decorators\Content\VimeoTrailerDecorator;
use App\Models\Cohort;
use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\ContentHierarchy;
use App\Modules\Content\Models\ContentInstructor;
use App\Modules\Content\Models\ContentPermissions;
use App\Modules\Content\Models\ContentStyle;
use App\Modules\Content\Models\Permission;
use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Enums\FilterType;
use App\Modules\Content\Models\Vimeo;
use App\Modules\UserManagementSystem\Enums\OnboardingSkillLevelEnum;
use Carbon\Carbon;
use Modules\Content\Models\ContentCreativity;
use Modules\Content\Models\ContentEssentials;
use Modules\Content\Models\ContentFocus;
use Modules\Content\Models\ContentGears;
use Modules\Content\Models\ContentLifestyle;
use Modules\Content\Models\ContentTheory;
use Modules\Content\Models\ContentTopic;
use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Providers\RailcontentURLProviderInterface;

class UpdateAssignmentSheetMusicSanity extends \Illuminate\Console\Command
{
    protected $signature = 'sanity:update-assignments {--id=}';

    protected $description = 'Update Assignments in Sanity';



    public function handle(): int
    {
        $idsString = '352293';
        $query = "*[
        // railcontent_id in [{$idsString}] &&
          defined(assignment)
   && count((assignment[].assignment_sheet_music_image)[count(@)>0])> 0
        ]{
          _id,
          railcontent_id,
          web_url_path,
          _type,
          assignment
        }";
        $sanityGateway = app()->make(SanityGateway::class);
        $documents = $sanityGateway->sanity->fetch($query);
        $sanityData = [];
        foreach($documents as $document){
            $assignments = [];

        foreach ($document['assignment'] as $assignment){
            $assignmentSheetMusicImage = collect($assignment['assignment_sheet_music_image'])
                ->map(fn ($url)  => (!is_array($url)) ? [
                    '_type' => FieldType::URL->name,
                    'url' => $url,
                    '_key' => $this->generateRandomKey(16)
                ] : $url)->toArray();
            $assignment['assignment_sheet_music_image'] = $assignmentSheetMusicImage;
            $timecode = $assignment['assignment_timecode'] ?? null;
            if($timecode)
            {
                $assignment['assignment_timecode'] = ($assignment['assignment_timecode'] == '')? null : (int)($assignment['assignment_timecode']);
            }

            $assignment['_key'] = $this->generateRandomKey(16);
            $assignments[] = $assignment;
        }

            $sanityData[$document['_id']] = [
                'assignment' => $assignments,
            ];


        }

        $sanityPatchesChunked = array_chunk($sanityData, 10, true);
        foreach($sanityPatchesChunked as $sanityPatchChunked) {
            dd($sanityPatchChunked);
           // $sanityGateway->patchSetMany($sanityPatchChunked);
        }

        return 1;
    }


    function generateRandomKey($length = 16) {
        return bin2hex(random_bytes($length));
    }

}
