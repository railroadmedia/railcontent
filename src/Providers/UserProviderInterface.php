<?php

namespace Railroad\Railcontent\Providers;

interface UserProviderInterface
{
    /**
     * @param $email
     * @param $password
     * @param $displayName
     * @param $avatar
     * @return mixed
     */
    public function create($email, $password, $displayName, $avatar);
}