<?php

namespace App\Modules\Referral\Exceptions;

class SaasquatchException extends ReferralException
{
    protected $message;

    /**
     * SaasquatchException constructor.
     *
     * @param string $message
     */
    public function __construct(string $message, $code = 503)
    {
        $this->message = $message;
        $this->title = 'Saasquatch Exception';
        $this->code = $code;
    }
}
