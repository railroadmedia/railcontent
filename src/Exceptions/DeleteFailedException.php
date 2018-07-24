<?php
namespace Railroad\Railcontent\Exceptions;

class DeleteFailedException extends \Exception
{
    public function render($request){
        return reply()->json(
            [],
            [
                'code' => 404,
                'errors' => [
                    'title' => 'Delete failed.',
                    'detail' => 'Delete failed.',
                ],
            ]
        );
    }

}