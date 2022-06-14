<?php

namespace App\Decorators\Notification;

class NotificationDecorator
{
    public function decorate($notifications)
    {
        if (app()->environment() == 'local') {
            $domain = 'devplatform.musora.com:8443';
        }

        foreach ($notifications as $index => $notification) {
            $url = str_replace(
                ['www.drumeo.com', 'laravel/public/members', 'members/forums'],
                [$domain, brand(), 'forums'],
                $notification['content']['url']
            );

            $notifications[$index]['content']['url'] = $url;
        }

        return $notifications;
    }
}
