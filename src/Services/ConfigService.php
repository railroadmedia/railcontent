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
    public static $tableUserPermissions;

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
    public static $tableCommentLikes;

    /**
     * @var string
     */
    public static $tableContentLikes;

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
     * @var string
     */
    public static $validationExemptionDate;

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
    public static $commentsAssignationOwnerIds;

    /**
     * @var array
     */
    public static $indexableContentStatuses;

    /**
     * @var array
     */
    public static $searchIndexValues;

    /**
     * @var array
     */
    public static $videoSync;

    /**
     * @var string
     */
    public static $redisPrefix;

    /**
     * @var string
     */
    public static $cacheDriver;

    /**
     * @var array
     */
    public static $availableBrands;

    /**
     * @var array
     */
    public static $decorators;

    /**
     * @var boolean
     */
    public static $useCollections;

    /**
     * @var integer
     */
    public static $contentHierarchyMaxDepth;

    /**
     * @var array
     */
    public static $contentHierarchyDecoratorAllowedTypes;

    /**
     * @var integer
     */
    public static $commentLikesDecoratorAmountOfUsers;

    /**
     * @var array
     */
    public static $controllerMiddleware;

    /**
     * @var array
     */
    public static $apiMiddleware;

    /**
     * @var array
     */
    public static $tableCommentsAggregates;
}