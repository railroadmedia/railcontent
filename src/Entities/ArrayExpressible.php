<?php

namespace Railroad\Railcontent\Entities;

use Doctrine\Common\Inflector\Inflector;

use Doctrine\ORM\PersistentCollection;
use Illuminate\Cache\Repository;
use Illuminate\Support\Facades\Cache;

abstract class ArrayExpressible
{
    private $cache;

    const CACHE_KEY_PREFIX = 'railcontent_fetch_';

    /**
     * ArrayExpressible constructor.
     *
     * @param $cache
     */
    public function __construct()
    {
        $this->cache = app()->make(Repository::class);
    }

    /**
     * @param $dotNotationString
     * @param string $default
     * @return mixed
     */
    public function fetch($dotNotationString, $default = '')
    {
        $hash = self::CACHE_KEY_PREFIX . $this->getId(). '_'. $dotNotationString;

        $results = Cache::store()->remember(
            $hash,
            5,
            function () use ($hash, $dotNotationString, $default){
                return $this->dot($dotNotationString) ?? $default;
            }
        );

        return $results;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }

    /**
     * @param $dotNotationString
     * @return mixed|ArrayExpressible|string|null
     */
    public function dot($dotNotationString)
    {
        $criteria = explode('.', $dotNotationString);

        $fields = $this;

        foreach ($criteria as $key => $criterion) {

            if ($criterion == 'fields') {
                continue;
            }

            $getterName = Inflector::camelize('get' . ucwords($criterion));

            if (($fields instanceof PersistentCollection)) {

                foreach ($fields as $field) {
                    if ($field instanceof ContentData && $field->getKey() == $criterion) {
                        $fields = $field->getValue();
                    } elseif (method_exists($fields, $getterName)) {
                        $fields = call_user_func([$field, $getterName]);
                        if (!$fields) {
                            return $fields;
                        }
                    } else {
                        $fields = null;
                    }
                }
            } else {
                if (method_exists($fields, $getterName)) {
                    $fields = call_user_func([$fields, $getterName]);
                    if (!$fields) {
                        return $fields;
                    }
                } else {
                    $extraProperties = $fields->getExtra();

                    if ($extraProperties && array_key_exists($criterion, $extraProperties)) {
                        $fields = $fields->getProperty($criterion);
                    } else {
                        return null;
                    }
                }
            }
        }

        return $fields;
    }

    /**
     * @return array
     */
    public function dot_deprecated()
    {
        $arr = $this->toArray();

        foreach ($arr as $key => $value) {

            if ($value instanceof PersistentCollection) {

                if ($value->isEmpty()) {
                    $arr[$key] = [];
                    continue;
                }

                $prefix = 'fields.';
                $propertyName = $key;
                $getterMethodName = 'get' . ucfirst($key);

                foreach ($value as $dataIndex => $elem) {

                    if ($elem instanceof ContentData) {
                        $prefix = 'data.';
                        $propertyName = $elem->getKey();
                        $propertyValue = $elem->getValue();
                    } else {
                        $propertyValue = $elem->$getterMethodName();
                    }

                    if ($elem->getPosition() == 1) {
                        $datumDots[$prefix . $propertyName] = $propertyValue;
                    }

                    $datumDots[$prefix . '*.' . $propertyName][] = $elem->toArray();
                    $datumDots[$prefix . $propertyName . '.' . $elem->getPosition()] = $propertyValue;
                    $datumDots[$prefix . '*.' . $propertyName . '.' . $elem->getPosition()] = $elem->toArray();

                    foreach ($elem as $datumColumnName => $datumColumnValue) {
                        if ($elem->getPosition() == 1) {
                            $datumDots[$prefix . $propertyName . '.' . $datumColumnName] = $datumColumnValue;
                        }
                        $datumDots[$prefix . $propertyName . '.' . $elem->getPosition() . '.' . $datumColumnName] =
                            $datumColumnValue;
                    }

                    unset($arr[$key]);

                    $arr = array_merge($arr, $datumDots);
                }
            } elseif ($value instanceof ContentInstructor) {

                $instructor = $value->getInstructor();

                $fieldDots['fields.instructor'] = $instructor->dot();
                $fieldDots['fields.*.instructor'] = [$instructor->dot()];
                $fieldDots['fields.instructor.' . $value->getPosition()] = $instructor->dot();

                unset($arr[$key]);

                $arr = array_merge($arr, $fieldDots);
            }
        }

        if (isset($arr['permissions'])) {

            foreach ($arr['permissions'] as $contentPermission) {
                $permission = $contentPermission->getPermission();
                $permissionDots['permissions.' . $permission->getName()] = $permission->toArray();
            }

            $arr['permissions'] = $permissionDots ?? [];
        }

        if (isset($arr['video'])) {

            $video = $arr['video'];

            $arr['fields.video'] = $video->dot();
            $arr['fields.video.vimeo_video_id'] = $video->getVimeoVideoId();
            $arr['fields.video.youtube_video_id'] = $video->getYoutubeVideoId();
            $arr['fields.video.length_in_seconds'] = $video->getLengthInSeconds();

            unset($arr['video']);
        }

        return $arr;
    }
}