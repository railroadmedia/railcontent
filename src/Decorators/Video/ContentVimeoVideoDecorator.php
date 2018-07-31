<?php

namespace Railroad\Railcontent\Decorators\Video;

use Carbon\Carbon;
use Illuminate\Cache\Repository;
use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Services\ConfigService;
use Vimeo\Vimeo;

class ContentVimeoVideoDecorator implements DecoratorInterface
{
    /**
     * @var Vimeo
     */
    private $vimeo;

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
    public function __construct()
    {
        $clientId = ConfigService::$videoSync['vimeo'][ConfigService::$brand]['client_id'];
        $clientSecret = ConfigService::$videoSync['vimeo'][ConfigService::$brand]['client_secret'];
        $accessToken = ConfigService::$videoSync['vimeo'][ConfigService::$brand]['access_token'];

        $vimeo = new Vimeo($clientId, $clientSecret);
        $vimeo->setToken($accessToken);

        $this->vimeo = $vimeo;

        $this->cache = app()->make(Repository::class);
    }

    public function decorate($contentResults)
    {
        foreach ($contentResults as $contentIndex => $content) {
            foreach ($content['fields'] as $field) {

                if ($field['key'] === 'video' && $field['value']['type'] == 'vimeo-video') {

                    foreach ($field['value']['fields'] as $videoField) {
                        if ($videoField['key'] === 'vimeo_video_id') {

                            // cache
                            $response = $this->cache->get(self::CACHE_KEY_PREFIX . $videoField['value']);

                            if (empty($response['body']['files'])) {
                                $response = $this->vimeo->request(
                                    '/me/videos/' . $videoField['value'],
                                    [],
                                    'GET'
                                );

                                $expirationDate =
                                    Carbon::parse($response['body']['download'][0]['expires'])
                                        ->diffInMinutes(
                                            Carbon::now()
                                        ) - 30;

                                $this->cache->put(
                                    self::CACHE_KEY_PREFIX . $videoField['value'],
                                    $response,
                                    $expirationDate
                                );
                            }

                            if (!empty($response['body']['files'])) {
                                foreach ($response['body']['files'] as $fileData) {
                                    if (isset($fileData['height'])) {
                                        $contentResults[$contentIndex]
                                        ['video_playback_endpoints'][] = [
                                            'file' => $fileData['link_secure'],
                                            'width' => $fileData['width'],
                                            'height' => $fileData['height'],
                                        ];

                                        $response['body']['pictures']['sizes'] = array_combine(
                                            array_column($response['body']['pictures']['sizes'], 'height'),
                                            $response['body']['pictures']['sizes']
                                        );

                                        $contentResults[$contentIndex]
                                        ['video_poster_image_url'] = $response['body']['pictures']
                                            ['sizes']['720']['link'] ?? '';

                                        ksort(
                                            $contentResults[$contentIndex]
                                            ['video_playback_endpoints']
                                        );
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return $contentResults;
    }
}