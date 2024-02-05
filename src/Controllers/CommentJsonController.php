<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Exceptions\NotAllowedException;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Repositories\CommentRepository;
use Railroad\Railcontent\Requests\CommentCreateRequest;
use Railroad\Railcontent\Requests\CommentUpdateRequest;
use Railroad\Railcontent\Requests\ReplyRequest;
use Railroad\Railcontent\Services\CommentService;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Transformers\DataTransformer;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Railroad\Mailora\Services\MailService;

class CommentJsonController extends Controller
{
    private CommentService $commentService;
    private MailService $mailService;

    /**
     * @param CommentService $commentService
     * @param MailService $mailService
     */
    public function __construct(CommentService $commentService, MailService $mailService)
    {
        $this->commentService = $commentService;
        $this->mailService = $mailService;

        $this->middleware(ConfigService::$controllerMiddleware);
    }

    /**
     * Call the method from the service to pull the comments based on the criteria passed in request:
     *      - content_id   => pull the comments for given content id
     *      - user_id      => pull user's comments
     *      - content_type => pull the comments for the contents with given type
     *  Return a Json paginated response with the comments
     *
     * @param Request $request
     * @return JsonPaginatedResponse
     */
    public function index(Request $request)
    {
        CommentRepository::$availableContentId = $request->get('content_id') ?? null;
        CommentRepository::$availableUserId = $request->get('user_id') ?? null;
        CommentRepository::$availableContentType = $request->get('content_type') ?? null;
        CommentRepository::$assignedToUserId = $request->get('assigned_to_user_id', false);
        CommentRepository::$conversationStatus = $request->get('conversation_status', false);

        $commentData = $this->commentService->getModeratorComments(
            $request->get('page', 1),
            $request->get('limit', 10),
            $request->get('sort', $request->get('sort', '-created_on')),
            auth()->id() ?? null
        );

        return reply()->json(
            $commentData['results'], [
                'totalResults' => $commentData['total_results'],
                'transformer' => DataTransformer::class,
                'meta' => [
                    'totalCommentsAndReplies' => $commentData['total_comments_and_results'],
                ],
            ]
        );
    }

    /**
     * Call the method from service that create a new comment if the request data pass the validation
     *
     * @param CommentCreateRequest $request
     * @return JsonResponse|NotAllowedException
     * @throws \Throwable
     */
    public function store(CommentCreateRequest $request)
    {
        $comment = $this->commentService->create(
            $request->get('comment'),
            $request->get('content_id'),
            null,
            auth()->id() ?? null,
            $request->get('display_name') ?? ''
        );

        throw_if(
            is_null($comment),
            new NotAllowedException('The content type does not allow comments.')
        );

        throw_if(
            ($comment === -1),
            new NotAllowedException('Only registered user can add comment. Please sign in.')
        );

        return reply()->json(
            [$comment],
            [
                'transformer' => DataTransformer::class,
            ]
        );
    }

    public function assignModerator(int $commentId)
    {
        //update comment with the data sent on the request
        $comment = $this->commentService->update(
            $commentId,
            ['assigned_moderator_id' => auth()->id() ?? null]
        );

        //if the user it's not logged in into the application
        throw_if(
            ($comment === 0),
            new NotAllowedException('Only registered user can modify own comments. Please sign in.')
        );

        //if the update response method = -1 => the user have not rights to update other user comment; we throw the exception
        throw_if(
            ($comment === -1),
            new NotAllowedException('Update failed, you can update only your comments.')
        );

        //if the update method response it's null the comment not exist; we throw the proper exception
        throw_if(
            is_null($comment),
            new NotFoundException('Update failed, comment not found with id: ' . $commentId)
        );

        return reply()->json(
            [$comment],
            [
                'transformer' => DataTransformer::class,
                'code' => 201,
            ]
        );
    }

    /**
     * Update a comment based on id and return it in JSON format
     *
     * @param integer $commentId
     * @param CommentCreateRequest $request
     * @return JsonResponse|NotAllowedException|NotFoundException
     * @throws \Throwable
     */
    public function update(CommentUpdateRequest $request, $commentId)
    {
        //update comment with the data sent on the request
        $comment = $this->commentService->update(
            $commentId,
            array_intersect_key(
                $request->all(),
                [
                    'comment' => '',
                    'content_id' => '',
                    'parent_id' => '',
                    'user_id' => '',
                    'display_name' => '',
                    'conversation_status' => '',
                ]
            )
        );

        //if the user it's not logged in into the application
        throw_if(
            ($comment === 0),
            new NotAllowedException('Only registered user can modify own comments. Please sign in.')
        );

        //if the update response method = -1 => the user have not rights to update other user comment; we throw the exception
        throw_if(
            ($comment === -1),
            new NotAllowedException('Update failed, you can update only your comments.')
        );

        //if the update method response it's null the comment not exist; we throw the proper exception
        throw_if(
            is_null($comment),
            new NotFoundException('Update failed, comment not found with id: ' . $commentId)
        );

        return reply()->json(
            [$comment],
            [
                'transformer' => DataTransformer::class,
                'code' => 201,
            ]
        );
    }

    /**
     * Call the delete method if the comment exist and the user have rights to delete the comment
     *
     * @param integer $contentId
     * @return JsonResponse|NotFoundException|NotAllowedException
     * @throws \Throwable
     */
    public function delete($commentId)
    {
        //delete comment
        $deleted = $this->commentService->delete($commentId);

        //if the delete method response it's null the comment not exist; we throw the proper exception
        throw_if(
            is_null($deleted),
            new NotFoundException('Delete failed, comment not found with id: ' . $commentId)
        );

        //if the delete method response it's false the mysql delete method was failed; we throw the proper exception
        throw_if(
            ($deleted === -1),
            new NotAllowedException('Delete failed, you can delete only your comments.')
        );

        return reply()->json(null, ['code' => 204]);
    }

    /**
     * Call the method from service that create a new comment if the request data pass the validation
     *
     * @param ReplyRequest $request
     * @return JsonResponse|NotAllowedException
     * @throws \Throwable
     */
    public function reply(ReplyRequest $request)
    {
        $reply = $this->commentService->create(
            $request->get('comment'),
            $request->get('content_id'),
            $request->get('parent_id'),
            auth()->id() ?? null
        );

        throw_if(
            is_null($request),
            new NotAllowedException('The content type does not allow comments.')
        );

        throw_if(
            ($reply === -1),
            new NotAllowedException('Only registered user can reply to comment. Please sign in.')
        );

        return reply()->json(
            [$reply],
            [
                'transformer' => DataTransformer::class,
            ]
        );
    }

    /**
     * Return the comments, the current page it's the page with the comment
     *
     * @param int $commentId
     * @param Request $request
     * @return JsonPaginatedResponse
     */
    public function getLinkedComment($commentId, Request $request)
    {
        $limitOnPage = $request->get('limit', 10);

        $activePage = $this->commentService->getCommentPage($commentId, $limitOnPage);

        //set the page on the request; we need this info for JsonPaginatedResponse
        $request->merge(['page' => $activePage]);

        $commentData = $this->commentService->getComments(
            $activePage,
            $limitOnPage,
            '-id'
        );

        return reply()->json(
            $commentData['results'],
            [
                'totalResults' => $commentData['total_results'],
                'transformer' => DataTransformer::class,
            ]
        );
    }

    /**
     * @param $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function report($id)
    {
        $comment = $this->commentService->get($id);

        if (!$comment) {
            throw new NotFoundHttpException();
        }

        $currentUser = auth()->user();
        $brand = config('railcontent.brand');

        $this->commentService->reportComment($id);

        $input['subject'] =
            'Comment reported by '.
            $currentUser['display_name'].
            " (".
            $currentUser['email'].
            ")";
        $input['sender-address'] = config('mailora.report-sender-address');
        $input['sender-name'] = config('mailora.report-sender-name');
        $input['lines'] = ['The following comment has been reported:'];
        $input['lines'][] = $comment['comment'];
        $input['lines'][] = $comment['url'];

        $input['unsubscribeLink'] = '';
        $input['alert'] =
            'Comment reported by '.
            $currentUser['display_name'].
            " (".
            $currentUser['email'].
            ")";

        $input['logo'] = config('mailora.'.$brand.'.logo-link');
        $input['type'] = 'layouts/inline/alert';
        $input['recipient'] =  config('mailora.'.$brand.'.report-comment-recipient');

        try {
            $this->mailService->sendSecure($input);
        } catch (\Exception $exception) {
            return response()->json([
                                        "success" => false,
                                        "message" => $exception->getMessage()
                                    ], 500);
        }

        return response()->json([
                                 "success" => true,
                                 "message" => "The comment was reported"
                             ], 200);
    }
}