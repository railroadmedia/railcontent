<?php

namespace Railroad\Railcontent\Exceptions;

class DeleteFailedException extends \Exception
{
    public function render($request)
    {
        return reply()->json(
            null,
            [
                'code' => 404,
                'totalResults' => 0,
                'errors' => [
                    'title' => 'Delete failed.',
                    'detail' => 'Delete failed.',
                ],
            ]
        );
    }

}