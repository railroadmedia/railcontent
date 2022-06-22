<?php

namespace App\Providers;

use App\Services\User\UserAccessService;
use ChatRoll;
use Railroad\MusoraApi\Contracts\ChatProviderInterface;
use Railroad\Railchat\Services\RailchatService;

class MusoraApiChatProvider implements ChatProviderInterface
{
 //TODO: INTEGRATE chatroll

    public function getEmbedUrl()
    : string
    {
        return '';
    }

    public function getCustomStyle()
    : array
    {
        return [];
    }

    public function getRailchatData()
    : array
    {

        $token = '';

        return [
            'apiKey' => config('railchat.get_stream_credentials')['key'],
            'chatChannelName' => config('railchat.chat_channel_name'),
            'questionsChannelName' => config('railchat.questions_channel_name'),
            'token' => $token,
        ];

    }
}
