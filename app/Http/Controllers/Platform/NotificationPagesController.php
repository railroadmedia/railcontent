<?php

namespace App\Http\Controllers\Platform;

use Illuminate\Http\Response;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Railroad\Railnotifications\Services\NotificationService;

class NotificationPagesController extends BaseController
{
    private NotificationService $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function index(Request $request, $brand): Response
    {
        $page = intval($request->get('page', 1));
        $amountPerPage = 20;

        $unreadCount = $this->notificationService->getUnreadCount(user()->id, brand());
        $readCount = $this->notificationService->getReadCount(user()->id, brand());

        $notifications = $this->notificationService->getManyPaginated(
            user()->id,
            $amountPerPage,
            (($page - 1) * $amountPerPage),
            brand()
        );

        $completeNotificationArrays = [];

        foreach ($notifications as $notification) {
            $completeNotificationArrays[] = [
                "id" => $notification['id'],
                "userName" => $notification['authorDisplayName'],
                "userAvatar" => $notification['authorAvatar'] ?? '',
                "isRead" => (!$notification['readOn']) ? false : true,
                "linkedContent" => [
                    'title' => $notification['content']['title'],
                    'url' => $notification['content']['url'],
                ],
                "createdOn" => $notification['createdOn']->format('M j, Y'),
                "subContent" => NotificationService::cleanStringForWebNotification(
                    $notification['content'] ? $notification['content']['comment'] : '',
                    200
                ),
                "notificationType" => $notification['type'],
            ];
        }

        return response()
            ->view('pages.notifications', [
                'notifications' => json_encode($completeNotificationArrays),
                'page' => $page,
                'notificationCount' => ($unreadCount + $readCount),
                'hasUnreadNotifications' => $unreadCount > 0,
            ])
            ->header('Cache-Control', 'private, max-age=0, no-cache, no-store');
    }
}
