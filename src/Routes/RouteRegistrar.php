<?php

namespace Railroad\Railcontent\Routes;

use Illuminate\Routing\Router;
use Railroad\Railcontent\Controllers\ApiJsonController;
use Railroad\Railcontent\Controllers\CommentJsonController;
use Railroad\Railcontent\Controllers\CommentLikeJsonController;
use Railroad\Railcontent\Controllers\ContentDatumJsonController;
use Railroad\Railcontent\Controllers\ContentHierarchyJsonController;
use Railroad\Railcontent\Controllers\ContentJsonController;
use Railroad\Railcontent\Controllers\ContentLikeJsonController;
use Railroad\Railcontent\Controllers\ContentProgressJsonController;
use Railroad\Railcontent\Controllers\FullTextSearchJsonController;
use Railroad\Railcontent\Controllers\MyListJsonController;
use Railroad\Railcontent\Controllers\PermissionJsonController;
use Railroad\Railcontent\Controllers\RemoteStorageJsonController;
use Railroad\Railcontent\Controllers\UserPermissionsJsonController;

class RouteRegistrar
{
    /**
     * @var Router
     */
    private $router;

    /**
     * RouteRegistrar constructor.
     *
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function registerAll()
    {
        $this->contentJSONApiRoutes();
        $this->permissionJSONApiRoutes();
        $this->progressJSONApiRoutes();
        $this->commentJSONApiRoutes();
        $this->searchJSONApiRoutes();
        $this->apiJSONRoutes();
        $this->administratorJSONApiRoutes();
    }

    public function contentJSONApiRoutes()
    {
        $this->router->group(
            [
                'prefix' => config('railcontent.route_prefix'),
                'middleware' => config('railcontent.route_middleware_logged_in_groups'),
            ],
            function () {

                $this->router->options(
                    'content',
                    ContentJsonController::class . '@options'
                )
                    ->name('content.options');

                $this->router->get(
                    'content',
                    ContentJsonController::class . '@index'
                )
                    ->name('content.index');

                $this->router->get(
                    'content/parent/{parentId}',
                    ContentJsonController::class . '@getByParentId'
                )
                    ->name('content.get-by-parent-id');

                $this->router->get(
                    'content/get-by-ids',
                    ContentJsonController::class . '@getByIds'
                )
                    ->name('content.get-by-ids');

                $this->router->get(
                    'content/{id}',
                    ContentJsonController::class . '@show'
                )
                    ->name('content.show');
            }
        );
    }

    public function permissionJSONApiRoutes()
    {
        $this->router->group(
            [
                'prefix' => config('railcontent.route_prefix'),
                'middleware' => config('railcontent.route_middleware_logged_in_groups'),
            ],
            function () {
                $this->router->get(
                    'permission',
                    PermissionJsonController::class . '@index'
                )
                    ->name('permissions.index');
            }
        );
    }

    public function progressJSONApiRoutes()
    {
        $this->router->group(
            [
                'prefix' => config('railcontent.route_prefix'),
                'middleware' => config('railcontent.route_middleware_logged_in_groups'),
            ],
            function () {
                $this->router->put(
                    'start',
                    ContentProgressJsonController::class . '@startContent'
                )
                    ->name('content.progress.start');

                $this->router->put(
                    'complete',
                    ContentProgressJsonController::class . '@completeContent'
                )
                    ->name('content.progress.complete');

                $this->router->put(
                    'reset',
                    ContentProgressJsonController::class . '@resetContent'
                )
                    ->name('content.progress.reset');

                $this->router->put(
                    'progress',
                    ContentProgressJsonController::class . '@saveProgress'
                )
                    ->name('content.progress.store');

                $this->router->get(
                    'content-like/{id}',
                    ContentLikeJsonController::class . '@index'
                )
                    ->name('content-likes.index');

                $this->router->put(
                    'content-like',
                    ContentLikeJsonController::class . '@like'
                )
                    ->name('content-like.store');

                $this->router->delete(
                    'content-like',
                    ContentLikeJsonController::class . '@unlike'
                )
                    ->name('content-like.delete');
            }
        );
    }

    public function commentJSONApiRoutes()
    {
        $this->router->group(
            [
                'prefix' => config('railcontent.route_prefix'),
                'middleware' => config('railcontent.route_middleware_logged_in_groups'),
            ],
            function () {
                $this->router->put(
                    'comment',
                    CommentJsonController::class . '@store'
                )
                    ->name('comment.store');

                $this->router->patch(
                    'comment/{id}',
                    CommentJsonController::class . '@update'
                )
                    ->name('comment.update');

                $this->router->delete(
                    'comment/{id}',
                    CommentJsonController::class . '@delete'
                )
                    ->name('comment.delete');

                $this->router->put(
                    'comment/reply',
                    CommentJsonController::class . '@reply'
                )
                    ->name('comment.reply');

                $this->router->get(
                    'comment',
                    CommentJsonController::class . '@index'
                )
                    ->name('comment.index');

                $this->router->get(
                    'comment/{id}',
                    CommentJsonController::class . '@getLinkedComment'
                )
                    ->name('comments.linked');

                $this->router->get(
                    'comment-likes/{id}',
                    CommentLikeJsonController::class . '@index'
                );

                $this->router->put(
                    'comment-like/{id}',
                    CommentLikeJsonController::class . '@store'
                )
                    ->name('comment-like.store');

                $this->router->delete(
                    'comment-like/{id}',
                    CommentLikeJsonController::class . '@delete'
                )
                    ->name('comment-like.delete');
            }
        );
    }

    public function searchJSONApiRoutes()
    {
        $this->router->group(
            [
                'prefix' => config('railcontent.route_prefix'),
                'middleware' => config('railcontent.route_middleware_logged_in_groups'),
            ],
            function () {
                $this->router->get(
                    'search',
                    FullTextSearchJsonController::class . '@index'
                )
                    ->name('search.linked');
            }
        );
    }

    public function administratorJSONApiRoutes()
    {
        $this->router->group(
            [
                'prefix' => config('railcontent.route_prefix'),
                'middleware' => config('railcontent.route_middleware_admin_groups'),
            ],
            function () {
                $this->router->put(
                    'content/datum',
                    ContentDatumJsonController::class . '@store'
                )
                    ->name('content.data.store');

                $this->router->patch(
                    'content/datum/{datumId}',
                    ContentDatumJsonController::class . '@update'
                )
                    ->name('content.data.update');

                $this->router->delete(
                    'content/datum/{datumId}',
                    ContentDatumJsonController::class . '@delete'
                )
                    ->name('content.data.delete');
                $this->router->put(
                    'user-permission',
                    UserPermissionsJsonController::class . '@store'
                )
                    ->name('user.permissions.store');

                $this->router->delete(
                    'user-permission/{userPermissionId}',
                    UserPermissionsJsonController::class . '@delete'
                )
                    ->name('user.permissions.delete');

                $this->router->get(
                    'user-permission',
                    UserPermissionsJsonController::class . '@index'
                )
                    ->name('user.permissions.index');

                $this->router->put(
                    'permission',
                    PermissionJsonController::class . '@store'
                )
                    ->name('permissions.store');

                $this->router->patch(
                    'permission/dissociate',
                    PermissionJsonController::class . '@dissociate'
                )
                    ->name('permissions.dissociate');

                $this->router->patch(
                    'permission/{permissionId}',
                    PermissionJsonController::class . '@update'
                )
                    ->name('permissions.update');

                $this->router->delete(
                    'permission/{permissionId}',
                    PermissionJsonController::class . '@delete'
                )
                    ->name('permissions.delete');

                $this->router->put(
                    'permission/assign',
                    PermissionJsonController::class . '@assign'
                )
                    ->name('permissions.assign');

                $this->router->put(
                    'content/hierarchy',
                    ContentHierarchyJsonController::class . '@store'
                )
                    ->name('content.hierarchy.store');

                $this->router->delete(
                    'content/hierarchy/{parentId}/{childId}',
                    ContentHierarchyJsonController::class . '@delete'
                )
                    ->name('content.hierarchy.delete');

                $this->router->options(
                    'content',
                    ContentJsonController::class . '@options'
                )
                    ->name('content.options');

                $this->router->put(
                    'content',
                    ContentJsonController::class . '@store'
                )
                    ->name('content.store');

                $this->router->patch(
                    'content/{contentId}',
                    ContentJsonController::class . '@update'
                )
                    ->name('content.update');

                $this->router->delete(
                    'soft/content/{id}',
                    ContentJsonController::class . '@softDelete'
                )
                    ->name('content.softDelete');

                $this->router->delete(
                    'content/{id}',
                    ContentJsonController::class . '@delete'
                )
                    ->name('content.delete');

                $this->router->put(
                    'remote',
                    RemoteStorageJsonController::class . '@put'
                )
                    ->name('remote.put');



            }
        );
    }

    public function apiJSONRoutes()
    {
        $this->router->group(
            [
                'prefix' => config('railcontent.api_route_prefix'),
                'middleware' => config('railcontent.route_middleware_logged_in_groups'),
            ],
            function () {
                $this->router->put(
                    'logout',
                    ApiJsonController::class . '@logout'
                );

                $this->router->put(
                    'profile',
                    ApiJsonController::class . '@getAuthUser'
                );

                $this->router->post(
                    'profile/update',
                    ApiJsonController::class . '@updateUser'
                );
            }

        );

        $this->router->group(
            [
                'prefix' => config('railcontent.api_route_prefix'),
                'middleware' => config('railcontent.route_middleware_public_groups'),
            ],
            function () {
                $this->router->put(
                    'login',
                    ApiJsonController::class . '@login'
                );

                $this->router->put(
                    'forgot',
                    ApiJsonController::class . '@forgotPassword'
                );
            }
        );

        $this->router->group(
            [
                'prefix' => config('railcontent.api_route_prefix'),
                'middleware' => config('railcontent.route_middleware_logged_in_groups'),
            ],
            function () {

                $this->router->get(
                    'content',
                    ContentJsonController::class . '@index'
                )
                    ->name('content.index');

                $this->router->get(
                    'content/parent/{parentId}',
                    ContentJsonController::class . '@getByParentId'
                )
                    ->name('content.get-by-parent-id');

                $this->router->get(
                    'content/get-by-ids',
                    ContentJsonController::class . '@getByIds'
                )
                    ->name('content.get-by-ids');

                $this->router->put(
                    'start',
                    ContentProgressJsonController::class . '@startContent'
                )
                    ->name('content.progress.start');

                $this->router->put(
                    'complete',
                    ContentProgressJsonController::class . '@completeContent'
                )
                    ->name('content.progress.complete');

                $this->router->put(
                    'reset',
                    ContentProgressJsonController::class . '@resetContent'
                )
                    ->name('content.progress.reset');

                $this->router->put(
                    'progress',
                    ContentProgressJsonController::class . '@saveProgress'
                )
                    ->name('content.progress.store');

                $this->router->get(
                    'content-like/{id}',
                    ContentLikeJsonController::class . '@index'
                )
                    ->name('content-likes.index');

                $this->router->put(
                    'content-like',
                    ContentLikeJsonController::class . '@like'
                )
                    ->name('content-like.store');

                $this->router->delete(
                    'content-like',
                    ContentLikeJsonController::class . '@unlike'
                )
                    ->name('content-like.delete');

                $this->router->put(
                    'comment',
                    CommentJsonController::class . '@store'
                )
                    ->name('comments.store');

                $this->router->patch(
                    'comment/{id}',
                    CommentJsonController::class . '@update'
                )
                    ->name('comments.update');

                $this->router->delete(
                    'comment/{id}',
                    CommentJsonController::class . '@delete'
                )
                    ->name('comments.delete');

                $this->router->put(
                    'comment/reply',
                    CommentJsonController::class . '@reply'
                )
                    ->name('comments.reply');

                $this->router->get(
                    'comment',
                    CommentJsonController::class . '@index'
                )
                    ->name('comments.index');

                $this->router->get(
                    'comment/{id}',
                    CommentJsonController::class . '@getLinkedComment'
                )
                    ->name('comments.linked');

                $this->router->put(
                    'comment-like/{id}',
                    CommentLikeJsonController::class . '@store'
                )
                    ->name('comment-like.store');

                $this->router->delete(
                    'comment-like/{id}',
                    CommentLikeJsonController::class . '@delete'
                )
                    ->name('comment-like.delete');

                $this->router->get(
                    'search',
                    FullTextSearchJsonController::class . '@index'
                )
                    ->name('search.linked');

                $this->router->get(
                    'all',
                    ContentJsonController::class . '@getAllContent'
                )
                    ->name('content.all');

                $this->router->get(
                    'our-picks',
                    ContentJsonController::class . '@getOurPicksContent'
                )
                    ->name('content.our.picks');

                $this->router->get(
                    'in-progress',
                    ContentJsonController::class . '@getInProgressContent'
                )
                    ->name('content.in.progress');

                $this->router->get(
                    'my-list',
                    MyListJsonController::class . '@getMyLists'
                )
                    ->name('mylist');

                $this->router->put(
                    'add-to-my-list',
                    MyListJsonController::class . '@addToPrimaryPlaylist'
                )
                    ->name('add.to.mylist');

                $this->router->put(
                    'remove-from-my-list',
                    MyListJsonController::class . '@removeFromPrimaryPlaylist'
                )
                    ->name('remove.from.mylist');

                $this->router->get(
                    'onboarding',
                    ApiJsonController::class . '@onboarding'
                )
                    ->name('onboarding');

                $this->router->get(
                    'shows',
                    ApiJsonController::class . '@getShows'
                )
                    ->name('shows');

                $this->router->get(
                    'comments',
                    ApiJsonController::class . '@getComments'
                )
                    ->name('comments');
            }
        );

    }
}