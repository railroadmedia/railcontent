<?php

namespace Railroad\Railcontent\Tests\Functional\Entities;

use Carbon\Carbon;
use Illuminate\Support\Debug\Dumper;
use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Factories\ContentContentFieldFactory;
use Railroad\Railcontent\Factories\ContentDatumFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Factories\ContentPermissionsFactory;
use Railroad\Railcontent\Factories\PermissionsFactory;
use Railroad\Railcontent\Repositories\PermissionRepository;
use Railroad\Railcontent\Repositories\UserPermissionsRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentEntityTest extends RailcontentTestCase
{
    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    /**
     * @var ContentDatumFactory
     */
    protected $datumFactory;

    /**
     * @var ContentContentFieldFactory
     */
    protected $fieldFactory;

    /**
     * @var PermissionsFactory
     */
    protected $permissionFactory;

    /**
     * @var ContentPermissionsFactory
     */
    protected $contentPermissionsFactory;

    /**
     * @var ContentService
     */
    protected $serviceBeingTested;

    /**
     * @var \Railroad\Railcontent\Repositories\UserPermissionsRepository
     */
    protected $userPermissionsRepository;

    protected function setUp()
    {
        parent::setUp();

        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->datumFactory = $this->app->make(ContentDatumFactory::class);
        $this->fieldFactory = $this->app->make(ContentContentFieldFactory::class);
        $this->permissionFactory = $this->app->make(PermissionsFactory::class);
        $this->contentPermissionsFactory = $this->app->make(ContentPermissionsFactory::class);
        $this->userPermissionsRepository = $this->app->make(UserPermissionsRepository::class);

        $this->serviceBeingTested = $this->app->make(ContentService::class);

    }

    public function test_get_by_entity_mapping()
    {

        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create();
        $linkedContent = $this->contentFactory->create();

        $linkedContentField = $this->fieldFactory->create(
            $content['id'],
            'linked-content',
            $linkedContent['id'],
            1,
            'content_id'
        );

        $randomLinkedContentField = $this->fieldFactory->create($linkedContent['id']);
        $randomLinkedContentDatum = $this->datumFactory->create($linkedContent['id']);

        $randomFields = [];
        $randomData = [];
        $randomPermissions = [];

        for ($i = 0; $i < 3; $i++) {
            $randomFields[] = $this->fieldFactory->create($content['id']);
        }

        for ($i = 0; $i < 3; $i++) {
            $randomData[] = $this->datumFactory->create($content['id']);
        }

        for ($i = 0; $i < 2; $i++) {
            $permission = $this->permissionFactory->create();
            $this->contentPermissionsFactory->create($content['id'], null, $permission['id']);
            $randomPermissions[] = $permission;
        }

        for ($i = 0; $i < 2; $i++) {
            $permission = $this->permissionFactory->create();
            $this->contentPermissionsFactory->create(null, $content['type'], $permission['id']);
            $randomPermissions[] = $permission;

            //assign user permission
            $this->userPermissionsRepository->create(
                [
                    'user_id' => $userId,
                    'permission_id' => $permission['id'],
                    'start_date' => Carbon::now()
                        ->toDateTimeString(),
                    'created_on' => Carbon::now()
                        ->toDateTimeString(),
                ]
            );
        }

        $results = $this->serviceBeingTested->getById($content['id']);
dd($results);
        $this->assertInstanceOf(ContentEntity::class, $results);

        $this->assertEquals($content['id'], $results->fetch('id'));
        $this->assertEquals($content['slug'], $results->fetch('slug'));
        $this->assertEquals($content['type'], $results->fetch('type'));
        $this->assertEquals($content['sort'], $results->fetch('sort'));
        $this->assertEquals($content['status'], $results->fetch('status'));
        $this->assertEquals($content['language'], $results->fetch('language'));
        $this->assertEquals($content['brand'], $results->fetch('brand'));
        $this->assertEquals($content['published_on'], $results->fetch('published_on'));
        $this->assertEquals($content['created_on'], $results->fetch('created_on'));
        $this->assertEquals($content['archived_on'], $results->fetch('archived_on'));

        foreach ($randomFields as $randomField) {
            $this->assertEquals($randomField['value'], $results->fetch('fields.' . $randomField['key']));
            $this->assertEquals(
                $randomField['value'],
                $results->fetch('fields.' . $randomField['key'] . '.' . $randomField['position'])
            );
            $this->assertEquals(
                $randomField['value'],
                $results->fetch(
                    'fields.' . $randomField['key'] . '.' . $randomField['type'] . '.' . $randomField['position']
                )
            );

            foreach ($randomField as $randomFieldColumnName => $randomFieldColumnValue) {
                $this->assertEquals(
                    $randomField[$randomFieldColumnName],
                    $results->fetch('fields.' . $randomField['key'] . '.' . $randomFieldColumnName)
                );
                $this->assertEquals(
                    $randomField[$randomFieldColumnName],
                    $results->fetch(
                        'fields.' . $randomField['key'] . '.' . $randomField['position'] . '.' . $randomFieldColumnName
                    )
                );
                $this->assertEquals(
                    $randomField[$randomFieldColumnName],
                    $results->fetch(
                        'fields.' .
                        $randomField['key'] .
                        '.' .
                        $randomField['type'] .
                        '.' .
                        $randomField['position'] .
                        '.' .
                        $randomFieldColumnName
                    )
                );
            }
        }

        foreach ($randomData as $randomDatum) {
            $this->assertEquals($randomDatum['value'], $results->fetch('data.' . $randomDatum['key']));
            $this->assertEquals(
                $randomDatum['value'],
                $results->fetch('data.' . $randomDatum['key'] . '.' . $randomDatum['position'])
            );

            foreach ($randomDatum as $randomDatumColumnName => $randomDatumColumnValue) {
                $this->assertEquals(
                    $randomDatum[$randomDatumColumnName],
                    $results->fetch('data.' . $randomDatum['key'] . '.' . $randomDatumColumnName)
                );
                $this->assertEquals(
                    $randomDatum[$randomDatumColumnName],
                    $results->fetch(
                        'data.' . $randomDatum['key'] . '.' . $randomDatum['position'] . '.' . $randomDatumColumnName
                    )
                );
            }
        }

        foreach ($randomPermissions as $randomPermission) {
            foreach ($randomPermission as $randomPermissionColumnName => $randomPermissionColumnValue) {
                $this->assertEquals(
                    $randomPermission[$randomPermissionColumnName],
                    $results->fetch('permissions.' . $randomPermission['name'] . '.' . $randomPermissionColumnName)
                );
            }
        }
    }

    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $app['config']->set('cache.default', 'array');
    }
}
