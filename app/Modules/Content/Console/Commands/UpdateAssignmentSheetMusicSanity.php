<?php

namespace App\Modules\Content\Console\Commands;

use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Models\Sanity\Enums\FieldType;

class UpdateAssignmentSheetMusicSanity extends \Illuminate\Console\Command
{
    protected $signature = 'sanity:update-assignments';

    protected $description = 'Update Assignments Sheet Music Image field to new structure in Sanity';

    public function handle(): int
    {
        $query = "*[
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
                $assignment['assignment_timecode'] = ($assignment['assignment_timecode'] == '' || is_null(['assignment_timecode']))? null : (int)($assignment['assignment_timecode']);
            }
            $assignments[] = $assignment;
        }

            $sanityData[$document['_id']] = [
                'assignment' => $assignments,
            ];


        }

        $sanityPatchesChunked = array_chunk($sanityData, 10, true);
        foreach($sanityPatchesChunked as $sanityPatchChunked) {
            $sanityGateway->patchSetMany($sanityPatchChunked);
        }

        return 1;
    }


    function generateRandomKey($length = 16) {
        return bin2hex(random_bytes($length));
    }

}
