<?php

namespace Railroad\Railcontent\Decorators\Mobile;

use Carbon\Carbon;
use Illuminate\Cache\Repository;
use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Support\Collection;
use Vimeo\Vimeo;

class VimeoVideoSourcesDecorator implements DecoratorInterface
{
    /**
     * @var Vimeo
     */
    private $vimeo;

    /**
     * @var Repository
     */
    private $cache;

    const CACHE_KEY_PREFIX = 'drumeo_vimeo_video_data_';

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

    public function decorate(Collection $contents)
    {
        $contentResults = $contents->toArray();

        foreach ($contentResults as $contentIndex => $content) {
            foreach ($content['fields'] as $field) {

                if (($field['key'] === 'video' || $field['key'] === 'qna_video') &&
                    $field['value']['type'] == 'vimeo-video') {

                    $prefix = '';

                    if ($field['key'] === 'qna_video') {
                        $prefix = 'qna_';
                    }

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
                                        [$prefix . 'video_playback_endpoints'][$fileData['height']] = [
                                            'file' => $fileData['link_secure'],
                                            'width' => $fileData['width'],
                                            'height' => $fileData['height'],
                                        ];

                                        $response['body']['pictures']['sizes'] = array_combine(
                                            array_column($response['body']['pictures']['sizes'], 'height'),
                                            $response['body']['pictures']['sizes']
                                        );

                                        $sizes = array_keys(
                                            $response['body']['pictures']['sizes']
                                        );

                                        $sizes = array_filter(
                                            $sizes,
                                            function ($element) {
                                                if ($element > 720) {
                                                    return false;
                                                }

                                                return true;
                                            }
                                        );

                                        $contentResults[$contentIndex]
                                        [$prefix . 'video_poster_image_url'] = $response['body']['pictures']
                                            ['sizes'][max($sizes)]['link'] ?? '';

                                        ksort(
                                            $contentResults[$contentIndex]
                                            [$prefix . 'video_playback_endpoints']
                                        );
                                    }
                                }

                                $contentResults[$contentIndex]
                                [$prefix . 'video_playback_endpoints'] = array_values(
                                    $contentResults[$contentIndex]
                                    [$prefix . 'video_playback_endpoints']
                                );
                            }
                        }
                    }
                }
            }
        }

        return new Collection($contentResults);
    }
}