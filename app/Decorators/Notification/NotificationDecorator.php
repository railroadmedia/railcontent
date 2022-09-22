<?php

namespace App\Decorators\Notification;

class NotificationDecorator
{
    public function decorate($notifications)
    {
        $domain = config('app.url');

        foreach ($notifications as $index => $notification) {
            $url = str_replace(
                ['www.drumeo.com', '/laravel/public', 'members/forums'],
                [$domain, '', brand().'/forums'],
                $notification->getContentUrl()
            );

            $notification->setContentUrl($url);
        }

        return $notifications;
    }
}
