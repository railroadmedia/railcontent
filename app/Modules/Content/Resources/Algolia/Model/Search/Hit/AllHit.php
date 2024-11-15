<?php

namespace App\Modules\Content\Resources\Algolia\Model\Search\Hit;

use Carbon\Carbon;

class AllHit extends MusoraHitClass
{
    public ?string $_id = null;
    public ?string $objectID = null;
    public ?string $rev = null;
    public ?int $railcontent_id = null;
    public ?string $brand = null;
    public ?string $description = null;
    public ?string $difficulty = null;
    /** @var ?string[]  */
    public ?array $instructor_names = null;
    public ?string $language = null;
    public ?int $popularity = null;
    public ?Carbon $published_on = null;
    public ?string $slug = null;
    public ?string $status = null;
    public ?string $thumbnail_url = null;
    public ?string $title = null;
    /** @var ?string[]  */
    public ?array $topics = null;
    public ?int $total_xp = null;
    public ?string $type = null;
    public ?string $web_url_path = null;

    protected function setProperty(string $propertyName, $value): void
    {
        //TODO thoughts: should we use classes/enums for type, brand, etc.?
        switch ($propertyName) {
            case 'published_on':
                $this->published_on = Carbon::parse($value);
                break;
            default:
                $this->$propertyName = $value;
        }
    }
}
