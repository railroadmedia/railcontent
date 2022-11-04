<?php

namespace App\Modules\Content\Models;

use App\Modules\Content\database\factories\InstructorFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Log;

/**
 * @property Collection $fields
 * @property Collection $data
 */
class Instructor extends Content
{
    use HasFactory;

    private $fieldTypes = [
        'is_coach' => 'boolean',
        'is_coach_of_the_month' => 'boolean',
        'is_house_coach' => 'boolean',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'tag' => 'string',
        'style' => 'string',
        'focus' => 'string',
        'endorsements' => 'string',
        'forum_thread_id' => 'string',
        'bands' => 'string',
        'name' => 'string'
    ];

    public function __construct()
    {
        parent::__construct([]);
        $this->type = 'instructor';
        $this->language = 'en-US';
        $this->created_on = Carbon::now();
    }

    protected static function newFactory(): InstructorFactory
    {
        return InstructorFactory::new();
    }

    private function setField(string $key, $value): void
    {
        /** @var ContentField $field */
        $field = $this->fields->where('key', '=', $key)->first();
        if (!$value) {
            if ($field) {
                Log::debug("Content Field ($this->id) $key $field->value deleted");
                $field->delete();
            }
            return;
        }
        if (!$field) {
            $field = $this->getNewContentField($key);
            Log::debug("Content Field ($this->id) $key inserted $value");
            $field->value = $value;
            $field->save();
            return;
        }
        if ($field->value != $value) {
            Log::debug("Content Field ($this->id) $key updated from '$field->value' to '$value'");
            $field->value = $value;
            $field->save();
        }
    }

    public function setFieldArray(string $key, array $values): void
    {
        $fields = $this->fields->where('key', '=', $key)->collect();
        $position = 1;
        foreach ($values as $value) {
            if (!$value) {
                continue;
            }
            $field = $fields->where('value', '=', $value)->first();
            if (!$field) {
                $field = $this->getNewContentField($key);
                Log::debug("Content Field ($this->id) $key inserted '$value'");
                $field->value = $value;
            }
            $field->position = $position;
            $field->save();
            $position++;
        }

        /** @var ContentField $field */
        foreach ($fields as $field) {
            if (!in_array($field->value, $values)) {
                Log::debug("Content Field ($this->id) $key $field->value deleted");
                $field->delete();
            }
        }
    }

    public function getNewContentField(string $key): ContentField
    {
        $field = new ContentField();
        $field->content_id = $this->id;
        $field->key = $key;
        $field->type = $this->fieldTypes[$key];
        return $field;
    }

    private function setData(string $key, $value)
    {
        /** @var ContentData $data */
        $data = $this->data->where('key', '=', $key)->first();
        if (!$value) {
            if ($data) {
                Log::debug("Content Data ($this->id) $key $data->value deleted");
                $data->delete();
            }
            return;
        }
        if (!$data) {
            $data = $this->getNewContentData($key);
            Log::debug("Content Data ($this->id) $key inserted $value");
            $data->value = $value;
            $data->save();
            return;
        }
        if ($data->value != $value) {
            Log::debug("Content Data ($this->id) $key updated from '$data->value' to '$value'");
            $data->value = $value;
            $data->save();
        }
    }


    public function getNewContentData(string $key): ContentData
    {
        $content = new ContentData();
        $content->content_id = $this->id;
        $content->key = $key;
        return $content;
    }

    public function setName($value)
    {
        $this->setField('name', $value);
        $this->name = $value;
    }


    public function setIsCoach($value)
    {
        $valueAsBool = filter_var($value, FILTER_VALIDATE_BOOLEAN);
        $this->setField('is_coach', $valueAsBool);
        $this->is_coach = $valueAsBool ? 1 : 0;
    }

    public function setIsCoachOfTheMonth($value)
    {
        $valueAsBool = filter_var($value, FILTER_VALIDATE_BOOLEAN);
        $this->setField('is_coach_of_the_month', $valueAsBool);
        $this->is_coach_of_the_month = $valueAsBool ? 1 : 0;
    }

    public function setIsHouseCoach($value)
    {
        $valueAsBool = filter_var($value, FILTER_VALIDATE_BOOLEAN);
        $this->setField('is_house_coach', $valueAsBool);
        $this->is_house_coach = $valueAsBool ? 1 : 0;
    }

    public function setIsActive($value)
    {
        $valueAsBool = filter_var($value, FILTER_VALIDATE_BOOLEAN);
        $this->setField('is_active', $valueAsBool);
        $this->is_active = $valueAsBool ? 1 : 0;
    }

    public function setIsFeatured($value)
    {
        $valueAsBool = filter_var($value, FILTER_VALIDATE_BOOLEAN);
        $this->setField('is_featured', $valueAsBool);
        $this->is_featured = $valueAsBool ? 1 : 0;
    }

    public function setFocusTags($value)
    {
        $values = array_map('trim', explode(',', $value));
        $this->setFieldArray('focus', $values);
    }

    public function setStyleTags($value)
    {
        $values = array_map('trim', explode(',', $value));
        $this->setFieldArray('style', $values);
    }

    public function setCardShortDescription($value)
    {
        $this->setData('focus_text', $value);
    }

    public function setShortBio($value)
    {
        $this->setData('short_bio', $value);
    }

    public function setLongBio($value)
    {
        $this->setData('long_bio', $value);
    }

    public function setBands($value)
    {
        $this->setField('bands', $value);
        $this->bands = null;
    }


    public function setForumThreadId($value)
    {
        $this->setField('forum_thread_id', $value);
    }

    public function setEndorsements($value)
    {
        $this->setField('endorsements', $value);
    }

    public function setFacebook($value)
    {
        $this->setData('link_facebook', $value);
    }

    public function setInstagram($value)
    {
        $this->setData('link_instagram', $value);
    }

    public function setTwitter($value)
    {
        $this->setData('link_twitter', $value);
    }

    public function setTiktok($value)
    {
        $this->setData('link_tiktok', $value);
    }

    public function setYouTube($value)
    {
        $this->setData('link_youtube', $value);
    }

    public function setCardImage($value)
    {
        $this->setData('coach_card_image', $value);
    }

    public function setBottomBannerImage($value)
    {
        $this->setData('coach_bottom_banner_image', $value);
    }

    public function setTopBannerImage($value)
    {
        $this->setData('coach_top_banner_image', $value);
    }

    public function setFeaturedImage($value)
    {
        $this->setData('coach_featured_image', $value);
    }

}
