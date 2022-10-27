<?php

namespace App\Modules\Content\Observers;

use App\Modules\Content\Models\ContentField;
use App\Modules\Content\Models\ContentFocus;
use App\Modules\Content\Models\ContentStyle;

class ContentFieldObserver
{
    public function created(ContentField $contentField): void
    {
        $this->createdOrUpdated($contentField);
    }

    public function updated(ContentField $contentField): void
    {
        $this->createdOrUpdated($contentField);
    }

    private function createdOrUpdated(ContentField $contentField): void
    {
        switch ($contentField->key) {
            case 'focus':
                /** @var ContentFocus $contentFocus */
                $contentFocus = ContentFocus::query()->where('content_id', '=', $contentField->content_id)->where(
                    'focus',
                    '=',
                    $contentField->value
                )->first() ?? new ContentFocus();
                $contentFocus->content_id = $contentField->content_id;
                $contentFocus->focus = $contentField->value;
                $contentFocus->position = $contentField->position;
                $contentFocus->save();
                break;
            case 'style':
                /** @var ContentStyle $contentStyle */
                $contentStyle = ContentStyle::query()->where('content_id', '=', $contentField->content_id)->where(
                    'style',
                    '=',
                    $contentField->value
                )->first() ?? new ContentStyle();
                $contentStyle->content_id = $contentField->content_id;
                $contentStyle->style = $contentField->value;
                $contentStyle->position = $contentField->position;
                $contentStyle->save();
                break;
        }
    }

    public function deleted(ContentField $contentField): void
    {
        switch ($contentField->key) {
            case 'focus':
                $contentFocus = ContentFocus::query()->where('content_id', '=', $contentField->content_id)->where(
                    'focus',
                    '=',
                    $contentField->value
                )->first();
                $contentFocus?->delete();
                break;
            case 'style':
                $contentStyle = ContentStyle::query()->where('content_id', '=', $contentField->content_id)->where(
                    'style',
                    '=',
                    $contentField->value
                )->first();
                $contentStyle?->delete();
                break;
        }
    }
}
