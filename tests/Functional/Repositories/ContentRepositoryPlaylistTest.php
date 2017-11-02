<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Carbon\Carbon;
use Railroad\Railcontent\Factories\ContentContentFieldFactory;
use Railroad\Railcontent\Factories\ContentDatumFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Factories\ContentPermissionsFactory;
use Railroad\Railcontent\Factories\PermissionsFactory;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\ContentHierarchyRepository;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentRepositoryPlaylistTest extends RailcontentTestCase
{
    /**
     * @var ContentRepository
     */
    protected $classBeingTested;

    /**
     * @var ContentHierarchyRepository
     */
    protected $contentHierarchyRepository;

    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    /**
     * @var ContentContentFieldFactory
     */
    protected $contentFieldFactory;

    /**
     * @var ContentDatumFactory
     */
    protected $contentDatumFactory;

    /**
     * @var PermissionsFactory
     */
    protected $permissionFactory;

    /**
     * @var ContentPermissionsFactory
     */
    protected $contentPermissionFactory;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(ContentRepository::class);

        $this->contentHierarchyRepository = $this->app->make(ContentHierarchyRepository::class);
        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->contentFieldFactory = $this->app->make(ContentContentFieldFactory::class);
        $this->contentDatumFactory = $this->app->make(ContentDatumFactory::class);
        $this->permissionFactory = $this->app->make(PermissionsFactory::class);
        $this->contentPermissionFactory = $this->app->make(ContentPermissionsFactory::class);

        ContentRepository::$pullFutureContent = true;
        ContentRepository::$availableContentStatues = false;
        ContentRepository::$includedLanguages = false;
    }

    public function test_get_by_parent_id()
    {
        $userId = rand();

        $playlist = [
            'slug' => ContentHelper::slugify($this->faker->words(rand(2, 6), true)),
            'type' => 'user_playlist',
            'status' => ContentService::STATUS_PUBLISHED,
            'brand' => ConfigService::$brand,
            'language' => 'en-US',
            'user_id' => $userId,
            'published_on' => Carbon::now()->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $playlist['id'] = $this->classBeingTested->create($playlist);

        $playlistContents = [];

        for ($i = 0; $i < 5; $i++) {
            $playlistContent = [
                'slug' => ContentHelper::slugify($this->faker->words(rand(2, 6), true)),
                'type' => 'user_playlist',
                'status' => ContentService::STATUS_PUBLISHED,
                'brand' => ConfigService::$brand,
                'language' => 'en-US',
                'published_on' => Carbon::now()->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $playlistContent['id'] = $this->classBeingTested->create($playlistContent);
            $playlistContent['fields'] = [];
            $playlistContent['datum'] = [];
            $playlistContent['permissions'] = [];

            $playlistContents[$playlistContent['id']] = $playlistContent;

            $this->contentHierarchyRepository->create(
                [
                    'parent_id' => $playlist['id'],
                    'child_id' => $playlistContent['id'],
                    'child_position' => $i
                ]
            );
        }

        $results = $this->classBeingTested->getByParentId($playlist['id']);

        $this->assertEquals(
            $playlistContents,
            $results
        );
    }
}