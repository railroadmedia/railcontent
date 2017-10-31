<?php

namespace Railroad\Railcontent\Helpers;

class ContentHelper
{
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
}