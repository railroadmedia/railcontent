<?php

namespace App\Decorators\Forums;

class UserSignatureDecorator
{
    public function decorate($posts)
    {
        foreach($posts as $post)
        {
            $domain = config('app.url');
            $url = str_replace(
                [
                    'https://www.drumeo.com',
                    'www.drumeo.com',
                    'https://www.pianote.com/members/forums',
                    'https://www.guitareo.com/members/forums',
                    '/laravel/public',
                    '"/members/forums'
                ],
                [
                    $domain,
                    $domain,
                    $domain.'pianote/forums',
                    $domain.'guitareo/forums',
                    '',
                    '"'.route('forums.show-categories'),
                ],
                $post['author']['signature']
            );
            $post['author']['signature'] = $url;
        }

        return $posts;
    }
}
