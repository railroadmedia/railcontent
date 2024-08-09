<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Support\Collection;

class PackBundleDecorator extends TypeDecoratorBase
{
    public static $skip = false;

    /**
     * @param Collection $contents
     * @return Collection
     */
    public function decorate(Collection $contents): Collection
    {
        $contentsOfType = $contents->where('type', 'pack-bundle');

        if ($contentsOfType->isEmpty() || self::$skip) {
            return $contents;
        }

        foreach ($contentsOfType as $contentIndex => $content) {
            $contentsOfType[$contentIndex]['xp'] = $content->fetch(
                'fields.xp',
                config('xp_ranks.pack_bundle_content_completed')
            );
            $contentsOfType[$contentIndex]['xp_bonus'] = $content->fetch(
                'fields.xp',
                config('xp_ranks.pack_bundle_content_completed')
            );

            $contentsOfType[$contentIndex]['lesson_count'] = $content['child_count'];
        }
        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
