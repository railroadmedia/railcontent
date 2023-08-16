<?php

namespace App\Modules\EventTracking\Avo;

class AvoHelper
{
    public static function defaultEventProperties($properties = [])
    {
        $defaultProperties = [
            'user_id_' => userIdString(),
        ];

        return array_merge($defaultProperties, $properties);
    }

}
