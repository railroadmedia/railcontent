<?php

namespace Railroad\Railcontent\Tests\Fixtures;

use League\Fractal\TransformerAbstract;
use Railroad\Railcontent\Contracts\UserInterface;

class UserTransformer extends TransformerAbstract
{
    public function transform(UserInterface $user)
    {
        return [
            'id' => $user->getId()
        ];
    }
}
