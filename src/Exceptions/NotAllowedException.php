<?php

namespace Railroad\Railcontent\Exceptions;

class NotAllowedException extends \Exception
{
    protected $message;

    /**
     * NotFoundException constructor.
     *
     * @param string $message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    public function render($request)
    {
        return response()->json(
            [
                'errors' => [
                    'title' => 'Not allowed.',
                    'detail' => $this->message,
                ],

            ],
            403
        );
    }

}