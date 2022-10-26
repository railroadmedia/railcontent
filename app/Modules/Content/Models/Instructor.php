<?php

namespace App\Modules\Content\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Collection $fields
 * @property Collection $data
 */
class Instructor extends Content
{
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
        'forum_thread_id' => 'string'
    ];

    public function __construct()
    {
        parent::__construct([]);
        $this->type = 'instructor';
        $this->language = 'en-US';
        $this->created_on = Carbon::now();
    }

    public function fields()
    {
        return $this->hasMany(ContentField::class, 'content_id');
    }

    public function data()
    {
        return $this->hasMany(ContentData::class, 'content_id');
    }

    private function setField(string $key, $value): void
    {
        $field = $this->fields->where('key', '=', $key)->first() ??
            $this->getNewContentField($key);
        $field->value = $value;
        $field->save();
    }

    public function setFieldArray(string $key, array $values): void
    {
        $fields = $this->fields->where('key', '=', $key)->collect();
        $position = 1;
        foreach ($values as $value) {
            $field = $fields->where('value', '=', $value)->first();
            if (!$field) {
                $field = $this->getNewContentField($key);
                $field->value = $value;
            }
            $field->position = $position;
            $field->save();
            $position++;
        }

        /** @var ContentField $field */
        foreach ($fields as $field) {
            if (!in_array($field->value, $values)) {
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
        $field = $this->data->where('key', '=', $key)->first() ??
            $this->getNewDataField($key);
        $field->value = $value;
        $field->save();
    }


    public function getNewDataField(string $key): ContentData
    {
        $content = new ContentData();
        $content->content_id = $this->id;
        $content->key = $key;
        return $content;
    }


    public function setIsCoach($value)
    {
        $valueAsBool = filter_var($value, FILTER_VALIDATE_BOOLEAN);
        $this->setField('is_coach', $valueAsBool);
    }

    public function setIsCoachOfTheMonth($value)
    {
        $valueAsBool = filter_var($value, FILTER_VALIDATE_BOOLEAN);
        $this->setField('is_coach_of_the_month', $valueAsBool);
    }

    public function setIsHouseCoach($value)
    {
        $valueAsBool = filter_var($value, FILTER_VALIDATE_BOOLEAN);
        $this->setField('is_house_coach', $valueAsBool);
    }

    public function setIsActive($value)
    {
        $valueAsBool = filter_var($value, FILTER_VALIDATE_BOOLEAN);
        $this->setField('is_active', $valueAsBool);
    }

    public function setIsFeatured($value)
    {
        $valueAsBool = filter_var($value, FILTER_VALIDATE_BOOLEAN);
        $this->setField('is_featured', $valueAsBool);
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
        $this->setData('short_description', $value);
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
        $this->setField('endorsements', $value);
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
        $this->setData('short_description', $value);
    }

    public function setInstagram($value)
    {
        $this->setData('short_description', $value);
    }

    public function setTwitter($value)
    {
        $this->setData('short_description', $value);
    }

    public function setTiktok($value)
    {
        $this->setData('short_description', $value);
    }

    public function setYouTube($value)
    {
        $this->setData('short_description', $value);
    }

}
