<?php

namespace Railroad\Railcontent\Services;

class ConfigService
{
    /**
     * @var int
     */
    public static $cacheTime;

    /**
     * @var string
     */
    public static $databaseConnectionName;
    
    /**
     * @var string
     */
    public static $connectionMaskPrefix;
    
    /**
     * @var string
     */
    public static $dataMode;

    /**
     * @var string
     */
    public static $tablePrefix;

    /**
     * @var string
     */
    public static $tableContent;

    /**
     * @var string
     */
    public static $tableContentHierarchy;

    /**
     * @var string
     */
    public static $tableContentVersions;

    /**
     * @var string
     */
    public static $tableContentFields;

    /**
     * @var string
     */
    public static $tableContentData;

    /**
     * @var string
     */
    public static $tablePermissions;

    /**
     * @var string
     */
    public static $tableContentPermissions;

    /**
     * @var string
     */
    public static $tableUserContentProgress;

    /**
     * @var string
     */
    public static $tablePlaylists;

    /**
     * @var string
     */
    public static $tablePlaylistContents;

    /**
     * @var string
     */
    public static $tableComments;

    /**
     * @var string
     */
    public static $tableCommentsAssignment;

    /**
     * @var string
     */
    public static $tableSearchIndexes;

    /**
     * @var array
     */
    public static $availableLanguages;

    /**
     * @var string
     */
    public static $defaultLanguage;

    /**
     * @var string
     */
    public static $brand;

    /**
     * @var array
     */
    public static $validationRules;

    /**
     * @var @array
     */
    public static $fieldOptionList;

    /**
     * @var array
     */
    public static $commentableContentTypes;

    /**
     * @var array
     */
    public static $commentsAssignation;

    /**
     * @var array
     */
    public static $searchableContentTypes;

    /**
     * @var array
     */
    public static $searchIndexValues;

    /**
     * @var array
     */
    public static $videoSync;
}