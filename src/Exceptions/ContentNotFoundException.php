<?php
namespace Railroad\Railcontent\Exceptions;

class ContentNotFoundException extends \Exception
{
    public function render($request){

        return response()->json(
            [
                'status' => 'error',
                'code' => 404,
                'total_results' => 0,
                'results' => [],
                'error' => [
                    'title' => 'Content not found.',
                    'detail' => 'No content with id ' . $request->request->get('content_id') . ' exists.',
                ]
            ],
            404
        );
    }

}