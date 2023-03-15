<?php

namespace Railroad\Railcontent\Exceptions;

class NotFoundException extends \Exception
{
    protected $message;
    protected $title;

    /**
     * NotFoundException constructor.
     *
     * @param string $message
     */
    public function __construct($message, $title = null)
    {
        $this->message = $message;
        $this->title = $title;
    }

    public function render($request)
    {
        return reply()->json(
            null,
            [
                'code' => 404,
                'totalResults' => 0,
                'errors' => [
                    'title' => $this->title ?? 'Entity not found.',
                    'detail' => $this->message,
                ],
            ]
        );
    }

}