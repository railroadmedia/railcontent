<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Vimeo\Vimeo;
use Vimeo\Exceptions\VimeoRequestException;

class CreateContentFromExternalResources extends Command
{
    protected $signature = 'CreateContentFromExternalResources {page=1}';
    protected $description = 'Content from external resources.';

    /**
     * @var ContentService
     */
    private $contentService;
    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * @var Vimeo
     */
    private $lib;

    private $perPage;
    private $page;

    public function __construct(
        ContentService $contentService,
        DatabaseManager $databaseManager
    )
    {
        parent::__construct();
        $this->contentService = $contentService;
        $this->databaseManager = $databaseManager;
    }

    public function handle()
    {
        $numberOnLastPage = null;
        $total = null;
        $totalPagesAvailable = null;
        $this->perPage = 100;

        $this->page = $this->argument('page');

        $this->info('Starting on page ' . $this->page . '.');

        $client_id = ConfigService::$videoSync['vimeo']['drumeo']['client_id'];
        $client_secret = ConfigService::$videoSync['vimeo']['drumeo']['client_secret'];
        $access_token = ConfigService::$videoSync['vimeo']['drumeo']['access_token'];

        $this->lib = new Vimeo($client_id, $client_secret);
        $this->lib->setToken($access_token);

        do {
            $contentCreatedCount = 0;
            $contentFieldsInsertData = [];

            $response = $this->getVideos();

            $videos = $response['body']['data'];

            if(!empty($videos)){
                foreach ($videos as $video) {

                    $uri = $video['uri'];
                    $id = str_replace('/videos/', '', $uri);
                    if (!is_numeric($id)) {
                        $this->info('URI "' . $uri . '" failed to convert to a numeric video id. (used: "$id = ' .
                            'str_replace(\'/videos/\', \'\', $uri);"');
                    }

                    $duration = $video['duration'];
                    if (!is_numeric($duration)) {
                        $this->info('Video failed to provide numeric duration value. (video with URI "' . $uri . '")');
                    }

                    if(empty($this->contentService->getBySlugAndType('vimeo-video-' . $id, 'vimeo-video'))){
                        $content = $this->contentService->create(
                            'vimeo-video-' . $id,
                            'vimeo-video',
                            ContentService::STATUS_PUBLISHED,
                            null,
                            null,
                            null,
                            Carbon::now()->toDateTimeString()
                        );

                        if (empty($content)) {
                            $contentCreationFailed[] = $id;
                        }else{
                            $contentCreatedCount++;
                        }

                        $contentFieldsInsertData[] = [
                            'content_id' => $content['id'],
                            'key' => 'vimeo_video_id',
                            'value' => $id,
                            'type' => 'string',
                            'position' => 1
                        ];

                        $contentFieldsInsertData[] = [
                            'content_id' => $content['id'],
                            'key' => 'length_in_seconds',
                            'value' => $duration,
                            'type' => 'integer',
                            'position' => 1
                        ];
                    }
                }
            }

            $firstIteration = is_null($total);

            if($firstIteration){
                $total = $response['body']['total'];
                $this->info('There are ' . $total . ' videos available to process.');
                $this->info('We are operating on them in chunks ("pages") of ' . $this->perPage . '.');
            }

            if(is_null($totalPagesAvailable)){
                $totalPagesAvailable = ceil($total / $this->perPage);
            }

            if(is_null($numberOnLastPage)){
                $numberOnLastPage = $total % $this->perPage;
            }

            if($firstIteration){
                $fullPagesToProcess = $totalPagesAvailable - $this->page;
                $videosToProcess = $numberOnLastPage + ( $fullPagesToProcess * $this->perPage );
                $this->info(
                    'Because we\'re starting on page ' . $this->page . ', we will here process ' .
                    $videosToProcess . ' videos.'
                );
            }

            $contentFieldsWriteSuccess = $this->databaseManager->connection(ConfigService::$databaseConnectionName)
                ->table(ConfigService::$tableContentFields)
                ->insert($contentFieldsInsertData);

            $this->info('');
            $this->info(
                '-------------- Summary for Page ' . $this->page .
                ' (of ' . $totalPagesAvailable . ') -------------'
            );

            if($contentFieldsWriteSuccess && empty($contentCreationFailed)){
                $this->info(
                    'Processed ' . count($videos) . ' videos. ' .
                    (count($contentFieldsInsertData) + $contentCreatedCount) . ' DB rows created.'
                );
            }else{
                if(!empty($contentCreationFailed)){
                    $this->info(
                        'There was|were ' . count($contentCreationFailed) . ' content creation failure(s):'
                    );
                    $this->info(print_r($contentCreationFailed,true));
                }
                if(!$contentFieldsWriteSuccess){
                    $this->info("contentFields write failed");
                }
            }

            $doNextPage = (($this->page * $this->perPage) + $numberOnLastPage) <= $total;

            $this->page++;

        } while ( $doNextPage );

        $this->info('');
        $this->info('------------------------------------------------------------');
        $this->info('Complete.');
    }

    private function getVideos()
    {
        $response = null;

        do{
            try{
                $success = true;
                $response = $this->lib->request( // https://developer.vimeo.com/api/endpoints/videos#GET/users/{user_id}/videos
                    '/me/videos',
                    [
                        'per_page' => $this->perPage,
                        'page' => $this->page
                    ],
                    'GET'
                );
            } catch (VimeoRequestException $e){
                $success = false;
                $this->info('Oops, timed-out. Trying page ' . $this->page . ' again.');
            }
        } while (!$success);

        return $response;
    }
}