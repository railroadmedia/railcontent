<?php

namespace App\Providers;

use ChatRoll;
use Railroad\MusoraApi\Contracts\ChatProviderInterface;
use Railroad\Railchat\Services\RailchatService;

class MusoraApiChatProvider implements ChatProviderInterface
{
    //TODO: INTEGRATE chatroll
    /**
     * @var RailchatService
     */
    private $railchatService;

    /**
     * MusoraApiChatProvider constructor.
     *
     * @param RailchatService $railchatService
     */
    public function __construct(RailchatService $railchatService)
    {
        $this->railchatService = $railchatService;
    }

    public function getEmbedUrl(): string
    {
        return '';
    }

    public function getCustomStyle(): array
    {
        return [];
    }

    public function getRailchatData(): array
    {

        $member = user();

        $token = $this->railchatService->getUserToken(
            $member->id,
            $member->display_name,
            $member->profile_picture_url,
            url()->route('platform.profile.dashboard', [$member->id]),
            $member->isAdmin(),
            $member->access_level
        );

        return [
            'apiKey' => config('railchat.drumeo.get_stream_credentials')['key'] ?? '',
            'chatChannelName' => config('railchat.drumeo.chat_channel_name'),
            'questionsChannelName' => config('railchat.drumeo.questions_channel_name'),
            'token' => $token,
        ];
    }
}
