<?php

namespace App\Modules\Content\Models\Sanity\Structure;

/**
 * Preview settings for a list item, to set how it will be rendered.
 * A common example would be rendering a list of artists by displaying a thumbnail, their name, and their genre.
 * @see https://www.sanity.io/docs/previews-list-views#9649441589d3
 */
class ListItemPreview
{
    public function __construct(public string $title, public ?string $subtitle = null, public ?string $media = null)
    {
        // DEV NOTE: title, subtitle, and media are the "standard" slots,
        // but it can take pretty much anything for custom component. Be sure to update this as needed.
    }

    /**
     * Get the array-formatted values for this preview,
     * so that it can render the display for the item in the list.
     *
     * @return array
     */
    public function toArray(): array
    {
        // a preview has three default slots: title, subtitle, and media
        $slots = [
            'title' => $this->title
        ];
        if ($this->subtitle) {
            $slots['subtitle'] = $this->subtitle;
        }
        if ($this->media) {
            $slots['media'] = $this->media;
        }
        return [
            'select' => $slots
        ];
    }
}
