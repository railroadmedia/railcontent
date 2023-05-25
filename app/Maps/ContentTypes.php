<?php

namespace App\Maps;

class ContentTypes
{
    /**
     * @return array
     */
    public static function searchableContentTypes()
    {
        $types = array_unique(
            array_merge(
                array_values(config('railcontent.showTypes')[config('railcontent.brand')] ?? []),
                config('railcontent.topLevelContentTypes'),
                config('railcontent.searchable_content_types', []),
                config('railcontent.liveContentTypes')
            )
        );
        sort($types);
        return $types;
    }

    /**
     * @return array
     */
    public static function userListContentTypes()
    {
        return array_merge(
            array_values(config('railcontent.showTypes')[config('railcontent.brand')] ?? []),
            config('railcontent.userListContentTypes')
        );
    }

    /**
     * @return array
     */
    /**
     * @return array
     */
    public static function liveContentTypes()
    {
        return array_merge(
            array_values(config('railcontent.showTypes')[config('railcontent.brand')] ?? []),
            config('railcontent.liveContentTypes')
        );
    }

    /**
     * @return array
     */
    /**
     * @return array
     */
    public static function contentReleaseContentTypes()
    {
        return array_merge(
            array_values(config('railcontent.showTypes')[config('railcontent.brand')] ?? []),
            config('railcontent.contentReleaseContentTypes')
        );
    }

    /**
     * @return array
     */
    /**
     * @return array
     */
    public static function catalogueContentTypes()
    {
        return array_merge(
            array_values(config('railcontent.showTypes')[config('railcontent.brand')] ?? []),
            config('railcontent.catalogueContentTypes')
        );
    }

    /**
     * @return array
     */
    public static function mapContentThemeColor($type)
    {
        $contentTypeMap = [];

        foreach (config('railcontent.topLevelContentTypes') as $contentType) {
            $contentTypeMap[$contentType] = $contentType;
        }

        foreach ((config('railcontent.showTypes')[config('railcontent.brand')] ?? []) as $show) {
            $contentTypeMap[$show] = 'show';
        }

        return !empty($contentTypeMap[$type]) ? $contentTypeMap[$type] : 'drumeo';
    }

    /**
     * @return array
     */
    public static function countedCompletedContentTypes()
    {
        return array_merge(
            array_values(config('railcontent.showTypes')[config('railcontent.brand')] ?? []),
            config('railcontent.countedCompletedContentTypes')
        );
    }

    /**
     * @return array
     */
    public static function ourPicksContentTypes()
    {
        return array_merge(
            array_values(config('railcontent.showTypes')[config('railcontent.brand')] ?? []),
            config('railcontent.homeOurPicksContentTypes')
        );
    }

    /**
     * @return array
     */
    public static function newContentTypes()
    {
        return array_merge(
            array_values(config('railcontent.showTypes')[config('railcontent.brand')] ?? []),
            config('railcontent.homeNewContentTypes')
        );
    }

    /**
     * @return array
     */
    public static function inProgressContentTypes()
    {
        return array_merge(
            array_values(config('railcontent.showTypes')[config('railcontent.brand')] ?? []),
            config('railcontent.homeInProgressContentTypes')
        );
    }

    /**
     * @return array
     */
    public static function dashboardInProgressContentTypes()
    {
        return array_merge(
            array_values(config('railcontent.showTypes')[config('railcontent.brand')] ?? []),
            config('railcontent.dashboardInProgressContentTypes')
        );
    }

    /**
     * @return array
     */
    public static function userProgressListContentTypes()
    {
        return array_merge(
            array_values(config('railcontent.showTypes')[config('railcontent.brand')] ?? []),
            config('railcontent.userProgressListContentTypes')
        );
    }

    /**
     * @return array
     */
    public static function singularContentTypes()
    {
        return array_merge(
            config('railcontent.showTypes')[config('railcontent.brand')] ?? [],
            config('railcontent.singularContentTypes')
        );
    }

    /**
     * @return array
     */
    public static function contentTypesWithChildren()
    {
        return config('railcontent.contentTypesWithChildren', []);
    }

    /**
     * @return array
     */
    public static function contentTypesWithSingularParent()
    {
        return config('railcontent.contentTypesWithSingularParent', []);
    }
}
