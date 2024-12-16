<?php

namespace App\Modules\Content\tests\Feature;

use App\Modules\Content\ApiGateways\SanityGateway;
use Modules\UserManagementSystem\Models\User;
use Railroad\Railcontent\Repositories\UserPermissionsRepository;
use Tests\TestCase;
use Sanity\Client as SanityClient;

class SanityGatewayTest extends TestCase
{
    private int $contentId = 367385;
    private int $userPermission = 1;
    private User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_needsAccessTrue(): void
    {
        $userId = user()->id;
        $sanityFetchResult = [
            [
                'type' => 'challenge',
                'permission_id' => ['2'],
                'lessons' => [['id' => 1, 'status' => 'published', 'permission_id' => ['2']]]
            ]
        ];
        $sanityGateway = $this->getMockedGateway($sanityFetchResult);
        $results = $sanityGateway->getByRailContentIds([$this->contentId], 'challenge');

        $this->assertEquals($results[0]['need_access'], true);
        $this->assertEquals($results[0]['lessons'][0]['need_access'], true);
    }

    public function test_needsAccessFalse(): void
    {
        $userId = user()->id;
        $sanityFetchResult = [
            [
                'type' => 'challenge',
                'permission_id' => ['1'],
                'lessons' => [['id' => 1, 'status' => 'published', 'permission_id' => ['1']]]
            ]
        ];
        $sanityGateway = $this->getMockedGateway($sanityFetchResult);
        $results = $sanityGateway->getByRailContentIds([$this->contentId], 'challenge');

        $this->assertEquals($results[0]['need_access'], false);
        $this->assertEquals($results[0]['lessons'][0]['need_access'], false);
    }

    private function getMockedGateway($data): SanityGateway
    {
        $this->partialMock(SanityClient::class, function ($mock) use ($data) {
            $mock->shouldReceive('fetch')->andReturn($data);
        });
        $this->partialMock(UserPermissionsRepository::class, function ($mock) use ($data) {
            $mock->shouldReceive('getUserPermissions')->andReturn([['permission_id' => $this->userPermission]]);
        });
        $sanity = app()->make(SanityGateway::class);
        return $sanity;
    }

}
