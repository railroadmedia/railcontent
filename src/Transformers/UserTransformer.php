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
            'display_name' => $user->getDisplayName(),
            'xp' => $user->getProperty('xp'),
            'access_level' => $user->getProperty('access_level'),
            'level_number' => '1.0'
        ];
    }
}
