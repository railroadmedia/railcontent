<?php

namespace App\Modules\Referral\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class ReferralException extends Exception
{
    protected $message;
    protected $title;
    protected $code;

    /**
     * ReferralException constructor.
     */
    public function __construct(string $message, $code = 500)
    {
        $this->message = $message;
        $this->title = 'Referral Exception';
        $this->code = $code;
    }

    public function render(): JsonResponse
    {
        return response()->json(
            [
                'errors' => [
                    [
                        'title' => $this->title,
                        'detail' => $this->message,
                    ]
                ],
                'code' => $this->code
            ],
        );
    }
}
