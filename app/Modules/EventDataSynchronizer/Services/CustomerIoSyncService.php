<?php

namespace App\Modules\EventDataSynchronizer\Services;

use Carbon\Carbon;
use Modules\UserManagementSystem\Models\User;
use Railroad\Railcontent\Repositories\ContentFollowsRepository;
use Railroad\Railcontent\Services\ConfigService as RailcontentConfigService;

class CustomerIoSyncService
{
    public const AttributeLimit = 1000;

    private ContentFollowsRepository $contentFollowsRepository;


    public function __construct(
        ContentFollowsRepository $contentFollowsRepository,
    ) {
        $this->contentFollowsRepository = $contentFollowsRepository;
    }

    public function getUsersCustomAttributes(User $user, array $brands = null): array
    {
        $membershipAccessAttributes = $this->getUsersMembershipAccessAttributes($user, $brands);
        $contentFollowAttributes = $this->getUsersContentFollowAttributes($user);

        return array_merge(
            $this->getUsersMusoraProfileAttributes($user),
            $membershipAccessAttributes,
            $contentFollowAttributes,
        );
    }

    public function getUsersMusoraProfileAttributes(User $user): array
    {
        $fullNameArray = [];

        if (!empty($user->first_name)) {
            $fullNameArray[] = $user->first_name;
        }

        if (!empty($user->last_name)) {
            $fullNameArray[] = $user->last_name;
        }

        return [
            'musora_profile_preffered-name' => !empty($fullNameArray) ? implode(' ', $fullNameArray) : null,
            'musora_profile_display-name' => $user->display_name,
            'musora_profile_gender' => $user->gender,
            'musora_profile_country' => $user->country,
            'musora_profile_region' => $user->region,
            'musora_profile_city' => $user->city,
            'musora_profile_birthday' => $user->birthday,
            'musora_phone-number' => $user->phone_number,
            'musora_timezone' => $user->timezone,
            'musora_notify_of_weekly_updates' => $user->notify_weekly_update > 0,
        ];
    }

    public function getUsersMembershipAccessAttributes(User $user, mixed $brands): array
    {
        $attributes = [];
        foreach ($brands as $brand) {
            $attributes += [
                $brand . "_membership_access-expiration-date" => !empty($user->membership_expiration_date) ? Carbon::parse(
                    $user->membership_expiration_date
                )->timestamp : null,
                $brand . "_membership_is_lifetime" => $user->is_lifetime_member ? "true" : "false",
                //$brand . '_membership_subscription_source_app-store' => $user->hasMobileMembership() ? "true" : "",
            ];
        }
        return $attributes;
    }


    /**
     * Attribute list:
     * BRAND_subscribed_coaches => 'ID123_FNAME_LNAME, ID1234_FNAME2_LNAME2, etc'
     */
    public function getUsersContentFollowAttributes(User $user, array $brands = []): array
    {
        // for now we'll sync all brands to all workspaces

        $contentFollowRows = $this->contentFollowsRepository->query()
            ->join(
                RailcontentConfigService::$tableContent,
                RailcontentConfigService::$tableContent . '.id',
                '=',
                RailcontentConfigService::$tableContentFollows . '.content_id'
            )
            ->where(
                [
                    RailcontentConfigService::$tableContent . '.type' => 'instructor',
                    RailcontentConfigService::$tableContentFollows . '.user_id' => $user->id,
                ]
            )
            ->get();

        // ['brand1' => ['ID_COACH_NAME', 'ID2_COACH_NAME'], 'brand2' => ['ID_COACH_NAME', 'ID2_COACH_NAME'],]
        $brandCoachFollows = [];

        foreach ($contentFollowRows as $contentFollowRow) {
            $brandCoachFollows[$contentFollowRow['brand']][] = $contentFollowRow['content_id'] . '_' . str_replace(
                '-',
                '_',
                $contentFollowRow['slug']
            );
        }

        $contentFollowAttributes = [];

        foreach ($brandCoachFollows as $contentBrand => $followContentIdsAndSlugsString) {
            $contentFollowAttributes[$contentBrand . '_subscribed_coaches'] = substr(
                implode(
                    ', ',
                    $followContentIdsAndSlugsString
                ),
                0,
                self::AttributeLimit
            );
        }

        return $contentFollowAttributes;
    }
}
