<?php

namespace Railroad\Railcontent\Helpers;

class ContentHelper
{
    /**
     * @param array $array
     * @param $column
     * @return array
     */
    public static function groupArrayBy(array $array, $column)
    {
        $result = [];

        foreach ($array as $element) {
            if (!isset($element[$column])) {
                continue;
            }

            $columnValue = $element[$column];

            if (isset($result[$columnValue])) {
                $result[$columnValue][] = $element;
            } else {
                $result[$columnValue] = [$element];
            }
        }

        return $result;
    }
    
    /**
     * @param array $content
     * @param string $key
     * @param integer $position
     * @param string|null $type
     * @return string|array|null
     */
    public static function getFieldValue(array $content, $key, $position = 1, $type = null)
    {
        if (empty($content['fields']) || !is_array($content['fields'])) {
            return null;
        }

        foreach ($content['fields'] as $field) {
            if (!is_null($type) && $field['type'] != $type) {
                continue;
            }

            if ($field['key'] == $key &&
                $field['position'] == $position) {

                return $field['value'];
            }
        }

        return null;
    }

    /**
     * @param array $content
     * @param string $key
     * @param integer $position
     * @param string $subKey
     * @param integer $subPosition
     * @param null $subType
     * @return string|null
     */
    public static function getFieldSubContentValue(
        array $content,
        $key,
        $position = 1,
        $subKey,
        $subPosition = 1,
        $subType = null
    ) {
        $subContent = self::getFieldValue($content, $key, $position, 'content');

        if (is_array($subContent)) {
            return self::getFieldValue($subContent, $subKey, $subPosition, $subType);
        }

        return null;
    }

    /**
     * @param array $content
     * @param string $key
     * @param integer $position
     * @return string|array|null
     */
    public static function getDatumValue(array $content, $key, $position = 1)
    {
        if (empty($content['data']) || !is_array($content['data'])) {
            return null;
        }

        foreach ($content['data'] as $field) {
            if ($field['key'] == $key &&
                $field['position'] == $position) {

                return $field['value'];
            }
        }

        return null;
    }

    /**
     * @param array $content
     * @param string $key
     * @param integer $position
     * @param string $subKey
     * @param integer $subPosition
     * @return string|null
     */
    public static function getDatumSubContentValue(
        array $content,
        $key,
        $position = 1,
        $subKey,
        $subPosition = 1
    ) {
        $subContent = self::getFieldValue($content, $key, $position, 'content');

        if (is_array($subContent)) {
            return self::getDatumValue($subContent, $subKey, $subPosition);
        }

        return null;
    }

    /**
     * @param $contents
     * @param $key
     * @param int $position
     * @param null $type
     * @return array
     */
    public static function getFilterOptionsSubContentFieldValue($contents, $key, $position = 1, $type = null)
    {
        $filterOptions = [];

        foreach ($contents as $content) {
            $filterOptions[$content['id']] = self::getFieldValue($content, $key, $position, $type);
        }

        return $filterOptions;
    }

    /**
     * @param $userId
     * @param $content
     * @return string
     */
    public static function getUserContentProgressState($userId, $content)
    {
        if (!empty($content['user_progress'][$userId]['state'])) {
            return $content['user_progress'][$userId]['state'];
        }

        return 'unbegun';
    }

    /**
     * @param $userId
     * @param $content
     * @return string
     */
    public static function getUserContentProgressPercent($userId, $content)
    {
        if (!empty($content['user_progress'][$userId]['progress_percent'])) {
            return $content['user_progress'][$userId]['progress_percent'];
        }

        return 0;
    }

    /**
     * @param $content
     * @param $playlistSlug
     * @param $userId
     * @return bool
     */
    public static function isContentInUserPlaylist($content, $playlistSlug, $userId)
    {
        if (!empty($content['user_playlists'][$userId])) {
            foreach ($content['user_playlists'][$userId] as $userPlaylistContent) {
                if ($userPlaylistContent['slug'] === $playlistSlug) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * @param $text
     * @return mixed|string
     */
    public static function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}