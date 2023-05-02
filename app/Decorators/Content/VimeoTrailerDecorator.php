<?php

namespace App\Decorators\Content;

use Illuminate\Cache\Repository;
use Railroad\Railcontent\Services\ConfigService;
use Vimeo\Vimeo;

class VimeoTrailerDecorator extends ModeDecoratorBase
{
    /**
     * @var Vimeo
     */
    private $vimeo;

    /**
     * @var Repository
     */
    private $cache;

    const CACHE_KEY_PREFIX = 'pianote_vimeo_video_data_';

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
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

    public function decorate($vimeoId)
    {
        $prefix = '';

        // cache
        $response = $this->cache->get(self::CACHE_KEY_PREFIX.$vimeoId);
        $captions = [];

        if (empty($response['body']['files']) || empty($response['body']['pictures']['sizes'])) {
            $response = $this->vimeo->request(
                '/me/videos/'.$vimeoId,
                [],
                'GET'
            );

            $textTractResponse = $this->vimeo->request('/videos/'.$vimeoId.'/texttracks', [], 'GET');

            $response['body']['text-tracks'] = $textTractResponse['body']['data'] ?? [];

            $this->cache->put(
                self::CACHE_KEY_PREFIX.$vimeoId,
                $response,
                3000
            );
        }

        if (!empty($response['body']['files'])) {
            $contentResults['vimeo_video_id'] = $vimeoId;
            $contentResults['length_in_seconds'] = $response['body']['duration'];
            foreach ($response['body']['files'] as $fileData) {
                if (isset($fileData['height'])) {
                    $contentResults
                    [$prefix.'video_playback_endpoints'][$fileData['height']] = [
                        'file' => $fileData['link'],
                        'width' => $fileData['width'],
                        'height' => $fileData['height'],
                    ];

                    $response['body']['pictures']['sizes'] = array_combine(
                        array_column($response['body']['pictures']['sizes'] ?? [], 'height'),
                        $response['body']['pictures']['sizes'] ?? []
                    );

                    $sizes = array_keys(
                        $response['body']['pictures']['sizes'] ?? []
                    );

                    $sizes = array_filter($sizes, function ($element) {
                        if ($element > 720) {
                            return false;
                        }

                        return true;
                    });

                    if (!empty($sizes)) {
                        $contentResults
                        [$prefix.'video_poster_image_url'] = $response['body']['pictures']
                            ['sizes'][max($sizes)]['link'] ?? '';
                    }

                    ksort(
                        $contentResults
                        [$prefix.'video_playback_endpoints']
                    );
                }

                if ($fileData['quality'] === 'hls') {
                    $contentResults['hlsManifestUrl'] = $fileData['link'];
                }

                $contentResults['captions'] = $captions;
            }


            $contentResults
            [$prefix.'video_playback_endpoints'] = array_values(
                $contentResults
                [$prefix.'video_playback_endpoints']
            );
        }

        return $contentResults;
    }
}
