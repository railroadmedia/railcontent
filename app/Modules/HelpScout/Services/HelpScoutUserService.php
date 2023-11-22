<?php

namespace App\Modules\HelpScout\Services;

use App\Modules\HelpScout\Factories\ClientFactory;
use App\Modules\HelpScout\Models\HelpScoutCustomer;
use App\Modules\HelpScout\Models\HelpScoutUser;
use App\Modules\UserManagementSystem\Services\UserService;
use HelpScout\Api\Conversations\ConversationFilters;
use HelpScout\Api\Conversations\ConversationRequest;

class HelpScoutUserService extends HelpScoutServiceBase
{
    private UserService $userService;

    public function __construct(
        ClientFactory $clientFactory,
        UserService $userService,
    ) {
        parent::__construct($clientFactory);
        $this->userService = $userService;
    }

    public function getHelpScoutUserIdFromUserId(int $userId): ?int
    {
        $userId = HelpScoutUser::query()->select('helpscout_user_id')->where(['user_id' => $userId,])
            ->first()?->helpscout_user_id;
        if (!$userId) {
            //TODO: Can we populate this data more efficiently?
            $this->populateHelpScoutUserData();

            $userId = HelpScoutUser::query()->select('helpscout_user_id')->where(['user_id' => $userId,])
                ->first();
        }
        return $userId;
    }

    public function getUserIdFromHelpScoutCustomerInfo(int $helpScoutCustomerId, string $helpScoutEmail): ?int
    {
        $userId = $this->getUserIdFromHelpScoutCustomerId($helpScoutCustomerId);
        if (!$userId) {
            $userId = $this->userService->getByEmailOrNull($helpScoutEmail)?->id;
        }
        return $userId;
    }

    private function getUserIdFromHelpScoutCustomerId(int $helpScoutCustomerId): ?int
    {
        $userId = HelpScoutCustomer::query()->select('internal_id')->where(['external_id' => $helpScoutCustomerId,])
            ->first()?->internal_id;
        return $userId;
    }

    public function populateHelpScoutUserData(): void
    {
        $externalHelpScoutUserData = $this->client->users()->list()->toArray();
        $localHelpScoutUserData = HelpScoutUser::all();
        foreach ($externalHelpScoutUserData as $item) {
            $email = $item->getEmail();
            if (!$email) {
                continue;
            }
            $user = $this->userService->getByEmailOrNull($email);
            if ($user) {
                $helpScoutUser = $localHelpScoutUserData->where(
                    'helpscout_user_id',
                    '=',
                    $item->getId()
                )->first() ?? new HelpScoutUser();
                $helpScoutUser->user_id = $user->id;
                $helpScoutUser->helpscout_user_id = $item->getId();
                $helpScoutUser->save();
            }
        }
    }

    public function updateConversationAssignedUser(int $conversationId, int $helpScoutUserId)
    {
        $this->client->conversations()->assign($conversationId, $helpScoutUserId);
    }

    public function getConversations(
        ConversationFilters $conversationFilters = null,
        ConversationRequest $conversationRequest = null
    ) {
        return $this->client->conversations()->list($conversationFilters, $conversationRequest);
    }

}
