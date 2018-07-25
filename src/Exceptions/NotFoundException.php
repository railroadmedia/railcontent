<?php

namespace Railroad\Railcontent\Exceptions;

class NotFoundException extends \Exception
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
        return reply()->json(
            null,
            [
                'code' => 404,
                'totalResults' => 0,
                'errors' => [
                    'title' => 'Entity not found.',
                    'detail' => $this->message,
                ],
            ]
        );
    }

}