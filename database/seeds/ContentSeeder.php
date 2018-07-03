<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\PermissionRepository;
use Railroad\Railcontent\Repositories\ContentPermissionRepository;

class ContentSeeder extends Seeder
{
    /**
     * @var \Railroad\Railcontent\Repositories\ContentRepository
     */
    private $contentRepository;

    /**
     * @var \Railroad\Railcontent\Repositories\PermissionRepository
     */
    private $permissionRepository;

    /**
     * @var \Railroad\Railcontent\Repositories\ContentPermissionRepository
     */
    private $contentPermissionRepository;

    /**
     * ContentSeeder constructor.
     *
     * @param \Railroad\Railcontent\Repositories\ContentRepository           $contentRepository
     * @param \Railroad\Railcontent\Repositories\PermissionRepository        $permissionRepository
     * @param \Railroad\Railcontent\Repositories\ContentPermissionRepository $contentPermissionRepository
     */
    public function __construct(
        ContentRepository $contentRepository,
        PermissionRepository $permissionRepository,
        ContentPermissionRepository $contentPermissionRepository
    ) {
        $this->contentRepository           = $contentRepository;
        $this->permissionRepository        = $permissionRepository;
        $this->contentPermissionRepository = $contentPermissionRepository;
    }

    public function run()
    {
        $permissionId = $this->permissionRepository->create([
            'name'  => 'aa',
            'brand' => 'brand'
        ]);

        for($i = 1; $i < 100000; $i++)
        {
            $contentId = $this->contentRepository->create([
                    'slug'         => 'drum-technique-made-easy-january-2017-semester-pack-bundle',
                    'type'         => 'pack-bundle',
                    'status'       => 'published',
                    'user_id'      => null,
                    'brand'        => 'brand',
                    'language'     => 'ro',
                    'published_on' => Carbon::now()->toDateTimeString(),
                    'created_on'   => Carbon::now()->toDateTimeString()
                ]
            );

            $contentPermission = $this->contentPermissionRepository->create([
                'content_id'    => $contentId,
                'permission_id' => $permissionId
            ]);
        }
    }
}