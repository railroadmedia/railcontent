<?php

namespace Railroad\Railcontent\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentDatumService;
use Railroad\Railcontent\Services\ContentFieldService;
use Railroad\Railcontent\Services\ContentService;
use Vimeo\Vimeo;
use Vimeo\Exceptions\VimeoRequestException;

class CreateCoaches extends Command
{
    protected $signature = 'CreateCoaches';
    protected $description = 'Create coach content for each instructor';

    private $contentService;
    private $contentFieldService;
    private $contentDatumService;
    private $databaseManager;

    public function __construct(
        ContentService $contentService,
        ContentFieldService $contentFieldService,
        ContentDatumService $contentDatumService,
        DatabaseManager $databaseManager
    ) {
        parent::__construct();
        $this->contentService = $contentService;
        $this->contentFieldService = $contentFieldService;
        $this->contentDatumService = $contentDatumService;
        $this->databaseManager = $databaseManager;
    }

    public function handle()
    {
        $existingCoaches = $this->databaseManager->connection(
            ConfigService::$databaseConnectionName
        )
            ->table(ConfigService::$tableContent)
            ->where([
                'type' => 'coach',
                'status' => ContentService::STATUS_PUBLISHED,
                'brand' => config('railcontent.brand'),
            ])
            ->get()->keyBy('slug');

        foreach($existingCoaches as $existingCoach){
            $this->contentFieldService->create(
                $existingCoach->id,
                'active',
                1,
                1,
                'boolean'
            );
        }

        $instructors = $this->databaseManager->connection(
            ConfigService::$databaseConnectionName
        )
            ->table(ConfigService::$tableContent)
            ->where([
                'type' => 'instructor',
                'status' => ContentService::STATUS_PUBLISHED,
                'brand' => config('railcontent.brand'),
            ])
            ->get();

        ContentRepository::$bypassPermissions = true;

        $countNewCoaches = 0;
        $countExistingCoaches = 0;

        foreach ($instructors as $instructor) {

            if (!array_key_exists($instructor->slug, $existingCoaches)) {
                $this->info(
                    'Create coach for instructor with slug:' . $instructor->slug . ' on brand:' . $instructor->brand
                );
                $coach = $this->contentService->create(
                    $instructor->slug,
                    'coach',
                    $instructor->status,
                    $instructor->language,
                    $instructor->brand,
                    $instructor->user_id,
                    $instructor->published_on
                );

                $instructorFields = $this->databaseManager->connection(
                    ConfigService::$databaseConnectionName
                )
                    ->table(ConfigService::$tableContentFields)
                    ->where([
                        'content_id' => $instructor->id,
                    ])
                    ->get();

                foreach ($instructorFields as $instructorField) {
                    $this->contentFieldService->create(
                        $coach['id'],
                        $instructorField->key,
                        $instructorField->value,
                        $instructorField->position,
                        $instructorField->type
                    );

                    if ($instructorField->key == 'name') {
                        $this->contentFieldService->create(
                            $coach['id'],
                            'title',
                            $instructorField->value,
                            $instructorField->position,
                            $instructorField->type
                        );
                    }
                }

                $instructorData = $this->databaseManager->connection(
                    ConfigService::$databaseConnectionName
                )
                    ->table(ConfigService::$tableContentData)
                    ->where([
                        'content_id' => $instructor->id,
                    ])
                    ->get();

                foreach ($instructorData as $instructorDatum) {
                    $this->contentDatumService->create(
                        $coach['id'],
                        $instructorDatum->key,
                        $instructorDatum->value,
                        $instructorDatum->position
                    );
                    if ($instructorDatum->key == 'head_shot_picture_url') {
                        $this->contentDatumService->create(
                            $coach['id'],
                            'thumbnail_url',
                            $instructorDatum->value,
                            $instructorDatum->position
                        );
                    }
                }

                $countNewCoaches++;
            } else {
               // $this->info('Exists for ' . $instructor->slug . ' coach with id: ' . $existingCoaches[$instructor->slug]->id);
                $countExistingCoaches++;
            }
        }

        $this->info('New coaches count:: ' . $countNewCoaches);

        $this->info('Existing coaches count:: ' . $countExistingCoaches);

        return true;
    }
}