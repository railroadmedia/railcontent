<?php
namespace Railroad\Railcontent\Exceptions;

class DeleteFailedException extends \Exception
{
    public function render($request){

        return response()->json(
            [
                'status' => 'error',
                'code' => 404,
                'total_results' => 0,
                'results' => [],
                'error' => [
                    'title' => 'Delete failed.',
                    'detail' => 'Delete failed.',
                ]
            ],
            404
        );
    }

}