<?php

namespace Railroad\Railcontent\Providers;

interface UserProviderInterface
{
    /**
     * @param $email
     * @param $password
     * @return mixed
     */
    public function create($email, $password);
}