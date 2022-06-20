<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\BaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Railroad\Railnotifications\Services\NotificationService;

class NotificationPagesController extends BaseController
{
    private NotificationService $notificationService;

    /**
     * @param NotificationService $notificationService
     */
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function index(Request $request, $brand)
    {
        $page = $request->get('page', 1);
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
                "createdOn" => $notification['createdOn']->format('M j, Y H:i a'),
                "subContent" => NotificationService::cleanStringForWebNotification(
                    $notification['content'] ? $notification['content']['comment'] : '',
                    200
                ),
                "notificationType" => $notification['type'],
            ];
        }

        //TODO: Delete dummy notifications when lesson page is ready and an create notifications dynamic
        for ($i = 1; $i < 35; $i++) {
            $completeNotificationArrays[] = [
                "id" => $i,
                "userName" => 'Roxana-'.$i,
                "userAvatar" => "https://d1923uyy6spedc.cloudfront.net/avatars/456299_1635372166131-1635372169-456299.jpg",
                "isRead" => false,
                "linkedContent" => [
                    'title' => 'Dummy content for a dummy notification',
                    'url' => '',
                ],
                "createdOn" => Carbon::now()
                    ->format('M j, Y H:i a'),
                "subContent" => NotificationService::cleanStringForWebNotification(
                    'Dummy notification, only for FE devs :)',
                    200
                ),
                "notificationType" => 'lesson comment reply',
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
