<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\PermissionRepository;
use Railroad\Railcontent\Repositories\ContentPermissionRepository;
use Railroad\Railcontent\Repositories\ContentFieldRepository;
use Faker\Generator;

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
     * @var \Railroad\Railcontent\Repositories\ContentFieldRepository
     */
    private $contentFieldRepository;

    private $faker;

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
        ContentPermissionRepository $contentPermissionRepository,
        ContentFieldRepository $contentFieldRepository,
        Generator $generator
    ) {
        $this->contentRepository           = $contentRepository;
        $this->permissionRepository        = $permissionRepository;
        $this->contentPermissionRepository = $contentPermissionRepository;
        $this->contentFieldRepository      = $contentFieldRepository;
        $this->faker                       = $generator;
    }

    public function run()
    {
        $permissionId = $this->permissionRepository->create([
            'name'  => $this->faker->word,
            'brand' => 'brand'
        ]);

        $no_of_rows = 100000;
        $range      = range(1, $no_of_rows);
        $chunksize  = 1000;

        foreach(array_chunk($range, $chunksize) as $chunk)
        {
            foreach($chunk as $i)
            {
                $user_data = [
                    'slug'         => $this->faker->word,
                    'type'         => $this->faker->word,
                    'status'       => 'published',
                    'user_id'      => null,
                    'brand'        => 'brand',
                    'language'     => $this->faker->languageCode,
                    'published_on' => Carbon::now()->toDateTimeString(),
                    'created_on'   => Carbon::now()->toDateTimeString()
                ];
                $contentId = $this->contentRepository->create($user_data);

                $contentPermission = $this->contentPermissionRepository->create([
                    'content_id'    => $contentId,
                    'permission_id' => $permissionId
                ]);

                $contentField = $this->contentFieldRepository->create([
                    'content_id' => $contentId,
                    'key'        => $this->faker->word,
                    'value'      => $this->faker->word,
                    'type'       => 'string'
                ]);
            }
        }
    }
}