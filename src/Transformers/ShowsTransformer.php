<?php

namespace Railroad\Railcontent\Transformers;

use League\Fractal\TransformerAbstract;

class ShowsTransformer extends TransformerAbstract
{

    public function transform(array $shows)
    {
        return $shows;

        $myPacks = [];
        $morePacks = [];
        $transformer = new ContentOldStructureTransformer();

        foreach($packs['myPacks'] as $myPack){

            $myPacks[] = $transformer->transform($myPack);
        }

        foreach($packs['morePacks'] as $morePack){

            $morePacks[] = $transformer->transform($morePack);
        }

        $packs['myPacks'] = $myPacks;

        $packs['morePacks'] = $morePacks;

        $packs['topHeaderPack'] = $transformer->transform($packs['topHeaderPack']);

        return $packs;
    }
}