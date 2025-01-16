<?php

namespace App\Modules\Content\Console\Commands;

use App\Modules\Content\ApiGateways\SanityGateway;

class UpdateParentTypeForGuitareoPlayAlongsSanity extends \Illuminate\Console\Command
{
    protected $signature = 'sanity:update-parent-type';

    protected $description = 'Update parent_type field for Guitareo Play-Alongs in Sanity';

    public function handle(): int
    {
        $query = "*[_type == 'play-along' && brand == 'guitareo'
        ]{
          _id,
          title,
          _type
        }";

        $sanityGateway = app()->make(SanityGateway::class);
        $documents = $sanityGateway->sanity->fetch($query);
        $sanityData = [];
        foreach($documents as $document){
            $sanityData[$document['_id']] = [
                'parent_type' => 'learning-path',
            ];
        }

        $sanityPatchesChunked = array_chunk($sanityData, 10, true);
        foreach($sanityPatchesChunked as $sanityPatchChunked) {
            $sanityGateway->patchSetMany($sanityPatchChunked);
        }

        return 1;
    }
}
