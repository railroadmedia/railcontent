<?php

namespace  App\Decorators\GroupedContent;

use App\Decorators\Content\ModeDecoratorBase;
use App\Decorators\Content\UrlDecorator;
use Railroad\Railcontent\Decorators\Entity\ContentEntityDecorator;
use Railroad\Railcontent\Support\Collection;

class GroupedContentDecorator extends ModeDecoratorBase
{

    public function decorate(Collection $contents)
    {
        $contentsOfType = $contents->whereIn('type', ['style','artist']);

        if ($contentsOfType->isEmpty()) {
            return $contents;
        }

        foreach($contents as $index=>$content){
            if($content['type'] == 'artist')
            {
                $contents[$index]['url'] = url()->route('platform.content.artist.show',[
                    'brand' => brand(),
                    'slug' => $content['artist']
                ]);
            }else{
                $contents[$index]['url'] = url()->route('platform.content.genre.show',[
                    'brand' => brand(),
                    'genre' => $content['grouped_by_field'],
                    'contentTypeName' => 'courses'
                ]);
            }
        }

        return $contents;
    }
}
