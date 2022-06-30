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
                "createdOn" => $notification['createdOn']->format('M j, Y'),
                "subContent" => NotificationService::cleanStringForWebNotification(
                    $notification['content'] ? $notification['content']['comment'] : '',
                    200
                ),
                "notificationType" => $notification['type'],
            ];
        }

        //TODO: Delete dummy notifications when lesson page is ready and an create notifications dynamic
        if ($request->has('dummy-data')) {
            $completeNotificationArrays = [];
            $unreadCount = 4;
            $readCount = 0;

            $completeNotificationArrays[] = [
                "id" => 1,
                "userName" => "Sharon Ransom",
                "userAvatar" => "https://dzryyo1we6bm3.cloudfront.net/avatars/441550_1628013566831-1628013569-441550.jpg",
                "isRead" => true,
                "linkedContent" => [
                    "title" => "Fix Your Matched Grip",
                    "url" => "/",
                ],
                "createdOn" => "Aug 12, 2021",
                "subContent" => "<p>Rob is an awesome teacher and this video shows not just his knowledge but is an example of how well he can communicate different concepts! Glad you enjoyed ",
                "notificationType" => "comment-reply",
            ];

            $completeNotificationArrays[] = [
                "id" => 2,
                "userName" => "FiremanKen",
                "userAvatar" => "https://dzryyo1we6bm3.cloudfront.net/avatars/351858_1619796955889-1619796959-351858.jpg",
                "isRead" => true,
                "linkedContent" => [
                    "title" => "The Todd Sucherman Show #13 - The Secret To Ride Cymbal Speed",
                    "url" => "/",
                ],
                "createdOn" => "Aug 16, 2021",
                "subContent" => "<p>Thanks, Todd. I will look at it. in DRM.</p>  <p>For those watching the Archive verstion of this Show # 13, i got a lot from watching it at half the speed. I ",
                "notificationType" => "comment-like",
            ];

            $completeNotificationArrays[] = [
                "id" => 3,
                "userName" => "AaronL - Linkmaster(Drumeo Mod)",
                "userAvatar" => "https://dzryyo1we6bm3.cloudfront.net/avatars/149869_1617933989252-1617933994-149869.jpg",
                "isRead" => true,
                "linkedContent" => [
                    "title" => "DIY Acoustic panels, suggestions on helpful guides?",
                    "url" => "/drumeo/forums/jump-to-post/287145",
                ],
                "createdOn" => "Aug 15, 2021",
                "subContent" => "<p>Use some Corning 703 Panels or Roxul Panels with Gilford of Maine cloth to cover it up. <br /><br />Victor Guidera who is the main sound engineer for Drumeo  ",
                "notificationType" => "thread-reply",
            ];

            $completeNotificationArrays[] = [
                "id" => 4,
                "userName" => "Sturl",
                "userAvatar" => "https://dzryyo1we6bm3.cloudfront.net/avatars/rn_image_picker_lib_temp_177531cf-d65f-4e70-9e91-9f70dc5c5780-1632044948-451846.jpg",
                "isRead" => false,
                "linkedContent" => [
                    "title" => "Introduce yourself to the Drumeo Community...",
                    "url" => "https://devplatform.musora.com:8443/drumeo/forums/jump-to-post/312046",
                ],
                "createdOn" => "Jun 23, 2022",
                "subContent" => "<br>Originally from Lawn Gyland but nobody can tell fron my accent<br>All types of music moves me<br>Will you srill need me? Will you still feed me when I'm 64?",
                "notificationType" => "forum-like",
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
