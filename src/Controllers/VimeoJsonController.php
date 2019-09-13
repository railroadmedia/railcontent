<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Services\ConfigService;
use Symfony\Component\HttpFoundation\Request;
use Vimeo\Vimeo;

class VimeoJsonController extends Controller
{
    use ValidatesRequests;

    /**
     * @var Vimeo
     */
    private $vimeo;

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
    }

    public function show(Request $request, $vimeoVideoId)
    {
        if (empty($vimeoVideoId)) {
            return response()->json(
                ['error' => 'Invalid vimeo video ID.'],
                201,
                [
                    'Content-Type' => 'application/vnd.api+json',
                ]
            );
        }

        $response = $this->vimeo->request(
            '/me/videos/' . $vimeoVideoId,
            [],
            'GET'
        )['body'] ?? [];

        if (!empty($response['error'])) {
            return response()->json($response, 404);
        }

        return response()->json($response);
    }
}
