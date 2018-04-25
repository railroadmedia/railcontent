<?php

namespace Railroad\Railcontent\Decorators\Video;

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
     * ContentVimeoVideoDecorator constructor.
     * @param Vimeo $vimeo
     */
    public function __construct()
    {
        var_dump(ConfigService::$videoSync);
        $clientId = ConfigService::$videoSync['vimeo'][ConfigService::$brand]['client_id'];
        $clientSecret = ConfigService::$videoSync['vimeo'][ConfigService::$brand]['client_secret'];
        $accessToken = ConfigService::$videoSync['vimeo'][ConfigService::$brand]['access_token'];

        $vimeo = new Vimeo($clientId, $clientSecret);
        $vimeo->setToken($accessToken);

        $this->vimeo = $vimeo;
    }

    public function decorate($contentResults)
    {
        foreach ($contentResults as $contentIndex => $content) {
            foreach ($content['fields'] as $field) {

                if ($field['key'] === 'video' && $field['value']['type'] == 'vimeo-video') {

                    foreach ($field['value']['fields'] as $videoField) {
                        if ($videoField['key'] === 'vimeo_video_id') {

                            $response = $this->vimeo->request(
                                '/me/videos/' . $videoField['value'],
                                [],
                                'GET'
                            );

                            if (!empty($response['body']['files'])) {
                                foreach ($response['body']['files'] as $fileData) {
                                    if (isset($fileData['height'])) {
                                        $contentResults[$contentIndex]
                                        ['vimeo_video_playback_endpoints'][$fileData['height']] =
                                            $fileData['link_secure'];

                                        ksort(
                                            $contentResults[$contentIndex]
                                            ['vimeo_video_playback_endpoints']
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