<?php

namespace Railroad\Railcontent\Decorators\Video;

use Carbon\Carbon;
use Illuminate\Cache\Repository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Resora\Decorators\DecoratorInterface;
use Vimeo\Vimeo;

class ContentVimeoVideoDecorator implements DecoratorInterface
{
    /**
     * @var Vimeo
     */
    private $vimeo;

    private $contentService;

    /**
     * @var Repository
     */
    private $cache;

    const CACHE_KEY_PREFIX = 'recordeo_vimeo_video_data_';

    /**
     * ContentVimeoVideoDecorator constructor.
     *
     * @param Vimeo $vimeo
     */
    public function __construct(ContentService $contentService)
    {
        $clientId = config('railcontent.video_sync')['vimeo'][config('railcontent.brand')]['client_id'];
        $clientSecret = config('railcontent.video_sync')['vimeo'][config('railcontent.brand')]['client_secret'];
        $accessToken = config('railcontent.video_sync')['vimeo'][config('railcontent.brand')]['access_token'];

        $vimeo = new Vimeo($clientId, $clientSecret);
        $vimeo->setToken($accessToken);

        $this->vimeo = $vimeo;

        $this->cache = app()->make(Repository::class);

        $this->contentService = $contentService;
    }

    public function decorate($contentResults)
    {
        if ($contentResults->getVideo()) {
            $videoId = $contentResults->getVideo();
            $video = $this->contentService->getById($videoId);
            $vimeoVideoId = $video->getVimeoVideoId();

            // cache
            $response = $this->cache->get(self::CACHE_KEY_PREFIX . $vimeoVideoId);

            $properties = $response['body']['files']??[];

            if (empty($response['body']['files'])) {
                $response = $this->vimeo->request(
                    '/me/videos/' . $vimeoVideoId,
                    [],
                    'GET'
                );

                if (!array_key_exists('error', $response['body'])) {

                    $expirationDate =
                        Carbon::parse($response['body']['download'][0]['expires'])
                            ->diffInMinutes(
                                Carbon::now()
                            ) - 30;

                    $this->cache->put(
                        self::CACHE_KEY_PREFIX . $vimeoVideoId,
                        $response,
                        $expirationDate
                    );

                    if (!empty($response['body']['files'])) {
                      //  $properties = [];

                        foreach ($response['body']['files'] as $fileData) {
                            if (isset($fileData['height'])) {
                                $properties[] = [
                                    'file' => $fileData['link_secure'],
                                    'width' => $fileData['width'],
                                    'height' => $fileData['height'],
                                ];

                                $response['body']['pictures']['sizes'] = array_combine(
                                    array_column($response['body']['pictures']['sizes'], 'height'),
                                    $response['body']['pictures']['sizes']
                                );

                                $contentResults->createProperty(
                                    'video_poster_image_url',
                                    $response['body']['pictures']
                                    ['sizes']['720']['link'] ?? ''
                                );
                            }
                        }


                    }
                }
            }

            $contentResults->createProperty(
                'vimeo_video_playback_endpoints',
                $properties
            );
        }
        return ($contentResults);
    }
}