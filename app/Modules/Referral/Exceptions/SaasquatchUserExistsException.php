<?php

namespace App\Modules\Referral\Exceptions;

class SaasquatchUserExistsException extends ReferralException
{
    /**
     * SaasquatchUserExistsException constructor.
     *
     * @param string $message
     */
    public function __construct(string $message = 'User already exists', $code = 400)
    {
        $this->message = $message;
        $this->title = 'Saasquatch Exception';
        $this->code = $code;
    }
}
