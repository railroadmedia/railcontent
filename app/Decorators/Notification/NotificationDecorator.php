<?php

namespace App\Decorators\Notification;

class NotificationDecorator
{
    public function decorate($notifications)
    {
        $domain = config('app.url');

        foreach ($notifications as $index => $notification) {
            $url = str_replace(
                ['https://www.drumeo.com', 'www.drumeo.com', 'laravel/public', 'members/forums', 'members/jump-to-comment'],
                [$domain, $domain, '', brand().'/forums', brand().'/jump-to-comment'],
                $notification->getContentUrl()
            );

            $notification->setContentUrl($url);
        }

        return $notifications;
    }
}
