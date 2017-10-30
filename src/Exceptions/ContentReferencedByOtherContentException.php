<?php

namespace Railroad\Railcontent\Exceptions;

class ContentReferencedByOtherContentException extends \Exception
{
    public function render($request){

        return response()->json(
            [
                'status' => 'error',
                'code' => 404,
                'total_results' => 0,
                'results' => [],
                'error' => [
                    'title' => 'Content is being referenced by other content.',
                    'detail' => 'This content is being referenced by other content (' . $request->request->get('linked_content_ids') . '), you must delete that content first.',
                ]
            ],
            404
        );
    }

}