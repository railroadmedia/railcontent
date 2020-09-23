<?php

namespace Railroad\Railcontent\Transformers;

use League\Fractal\TransformerAbstract;
use Railroad\Railcontent\Serializer\OldStyleWithoutDataForArraySerializer;
use Spatie\Fractal\Fractal;

class PacksTransformer extends TransformerAbstract
{

    public function transform(array $packs)
    {
        $packs['myPacks'] =
            Fractal::create()
                ->collection($packs['myPacks'])
                ->transformWith(ContentOldStructureTransformer::class)
                ->serializeWith(OldStyleWithoutDataForArraySerializer::class)
                ->toArray();

        $packs['morePacks'] =
            Fractal::create()
                ->collection($packs['morePacks'])
                ->transformWith(ContentOldStructureTransformer::class)
                ->serializeWith(OldStyleWithoutDataForArraySerializer::class)
                ->toArray();

        $packs['topHeaderPack'] =
            Fractal::create()
                ->item($packs['topHeaderPack'])
                ->transformWith(ContentOldStructureTransformer::class)
                ->serializeWith(OldStyleWithoutDataForArraySerializer::class)
                ->toArray();

        return $packs;
    }
}