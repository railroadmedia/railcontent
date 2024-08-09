<?php

namespace App\Maps;

class ContentTypes
{
    public static function searchableContentTypes(): array
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

    public static function userListContentTypes(): array
    {
        return array_merge(
            array_values(config('railcontent.showTypes')[config('railcontent.brand')] ?? []),
            config('railcontent.userListContentTypes')
        );
    }

    /**
     * @return array
     */
    public static function liveContentTypes(): array
    {
        return array_merge(
            array_values(config('railcontent.showTypes')[config('railcontent.brand')] ?? []),
            config('railcontent.liveContentTypes')
        );
    }

    /**
     * @return array
     */
    public static function contentReleaseContentTypes(): array
    {
        return array_merge(
            array_values(config('railcontent.showTypes')[config('railcontent.brand')] ?? []),
            config('railcontent.contentReleaseContentTypes')
        );
    }

    /**
     * @return array
     */
    public static function catalogueContentTypes(): array
    {
        return array_merge(
            array_values(config('railcontent.showTypes')[config('railcontent.brand')] ?? []),
            config('railcontent.catalogueContentTypes')
        );
    }

    public static function mapContentThemeColor($type): array
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

    public static function countedCompletedContentTypes(): array
    {
        return array_merge(
            array_values(config('railcontent.showTypes')[config('railcontent.brand')] ?? []),
            config('railcontent.countedCompletedContentTypes')
        );
    }

    public static function ourPicksContentTypes(): array
    {
        return array_merge(
            array_values(config('railcontent.showTypes')[config('railcontent.brand')] ?? []),
            config('railcontent.homeOurPicksContentTypes')
        );
    }

    public static function newContentTypes(): array
    {
        return array_merge(
            array_values(config('railcontent.showTypes')[config('railcontent.brand')] ?? []),
            config('railcontent.homeNewContentTypes')
        );
    }

    public static function inProgressContentTypes(): array
    {
        return array_merge(
            array_values(config('railcontent.showTypes')[config('railcontent.brand')] ?? []),
            config('railcontent.homeInProgressContentTypes')
        );
    }

    public static function dashboardInProgressContentTypes(): array
    {
        return array_merge(
            array_values(config('railcontent.showTypes')[config('railcontent.brand')] ?? []),
            config('railcontent.dashboardInProgressContentTypes')
        );
    }

    public static function userProgressListContentTypes(): array
    {
        return array_merge(
            array_values(config('railcontent.showTypes')[config('railcontent.brand')] ?? []),
            config('railcontent.userProgressListContentTypes')
        );
    }

    public static function singularContentTypes(): array
    {
        return array_merge(
            config('railcontent.showTypes')[config('railcontent.brand')] ?? [],
            config('railcontent.singularContentTypes')
        );
    }

    public static function contentTypesWithChildren(): array
    {
        return config('railcontent.contentTypesWithChildren', []);
    }

    public static function contentTypesWithSingularParent(): array
    {
        return config('railcontent.contentTypesWithSingularParent', []);
    }
}
