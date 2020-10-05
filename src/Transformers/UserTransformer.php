<?php

namespace Railroad\Railcontent\Transformers;

use League\Fractal\TransformerAbstract;
use Railroad\Railcontent\Entities\User;

class UserTransformer extends TransformerAbstract
{
    /**
     * @param User $user
     *
     * @return array
     */
    public function transform(User $user)
    {

        return [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'avatar' => $user->getAvatar(),
            'fields.profile_picture_image_url' => $user->getAvatar(),
            'display_name' => $user->getDisplayName(),
            'xp' => $user->getProperty('xp'),
            "xp_level" => $user
                ->getProperty('xp_level'),
            'access_level' => $user->getProperty('access_level'),
            'level_number' =>  $user->getProperty('level_number'),
            'isAdmin'  => $user->getProperty('is_admin')
        ];
    }
}
