<?php

namespace App\Decorators\Notification;

class NotificationDecorator
{
    public function decorate($notifications)
    {
        if (app()->environment() == 'local') {
            $domain = 'devplatform.musora.com:8443';
        } else {
            $domain = env('APP_URL');
        }

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
