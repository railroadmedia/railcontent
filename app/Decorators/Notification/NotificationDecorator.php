<?php

namespace App\Decorators\Notification;

class NotificationDecorator
{
    public function decorate($notifications)
    {
        $domain = config('app.url');

        foreach ($notifications as $index => $notification) {
            $brand = $notification->getBrand();

            $url = str_replace(
                [
                    'https://www.drumeo.com',
                    'www.drumeo.com',
                    'https://www.pianote.com',
                    'https://www.singeo.com',
                    '/laravel/public',
                    'members/forums',
                    'members/jump-to-comment',
                    'https://www.guitareo.com//jump-to-comment',
                    'https://www.guitareo.com',
                    'www.guitareo.com',
                    'https://www.pianote.com//jump-to-comment',
                    'https://www.musora.com//jump-to-comment',
                    '//jump-to-comment',
                    '//forums/jump-to-post',
                    'https://www.pianote.comhttps://www.musora.com/pianote',
                ],
                [
                    $domain,
                    $domain,
                    $domain,
                    $domain,
                    '',
                    $brand.'/forums',
                    $brand.'/jump-to-comment',
                    $domain.'/'.$brand.'/jump-to-comment',
                    $domain,
                    $domain,
                    $domain.'/'.$brand.'/jump-to-comment',
                    $domain.'/'.$brand.'/jump-to-comment',
                    $domain.'/'.$brand.'/jump-to-comment',
                    $domain.'/'.$brand.'/forums/jump-to-post',
                    $domain.'/'.$brand
                ],
                $notification->getContentUrl()
            );

            if ((str_starts_with($url, '/drumeo/jump-to-comment')) || (str_starts_with($url, '/drumeo/forums'))) {
                $url = $domain.$url;
            }
            if ((str_starts_with($url, '/pianote/jump-to-comment'))  || (str_starts_with($url, '/pianote/forums'))) {
                $url = $domain.$url;
            }
            if ((str_starts_with($url, '/singeo/jump-to-comment'))  || (str_starts_with($url, '/singeo/forums'))) {
                $url = $domain.$url;
            }
            if ((str_starts_with($url, '/guitareo/jump-to-comment'))  || (str_starts_with($url, '/guitareo/forums'))) {
                $url = $domain.$url;
            }

            $notification->setContentUrl($url);
        }

        return $notifications;
    }
}
