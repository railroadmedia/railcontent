<?php

namespace App\Console\Commands;

use App\Decorators\Content\LiveEventDecorator;
use App\Decorators\Content\PackDecorator;
use App\Decorators\Content\SemesterPackDecorator;
use Illuminate\Console\Command;
use Railroad\Railcontent\Repositories\CommentRepository;
use Railroad\Railcontent\Services\CommentService;

class CheckCommentsUrl extends Command
{
    protected $signature = 'check:urls';
    protected $description = 'Check urls from comments/replies';

    public const HTML_HREF_REGEX_PATTERN = '#<a[^>]+href=\"(.*?)\"[^>]*>#';

    public function handle(
        CommentRepository $commentRepository,
        CommentService $commentService
    ): void {
        // Disable decorators
        SemesterPackDecorator::$skip = true;
        PackDecorator::$skip = true;
        LiveEventDecorator::$skip = true;

        $this->info("Start verification ");

        // Query comments with href attribute containing "href="
        $comments =
            $commentRepository->query()
                ->where('comment', 'LIKE', '%href="/%')
                //->where('id', '>=', 206167)
                //->whereNotNull('parent_id')
                ->orderByRaw('id desc')
                ->get();

        $incorrectData = [];

        $this->withProgressBar($comments, function ($comment) use ($commentService, &$incorrectData) {
            CommentRepository::$availableContentId = $comment['content_id'];
            $decoratedComments = $commentService->getComments(1, -1);

            foreach ($decoratedComments['results'] as $decoratedComment) {
                if ($decoratedComment['id'] == $comment['id']) {
                    if (preg_match_all(self::HTML_HREF_REGEX_PATTERN, $decoratedComment['comment'], $matches)) {
                        foreach ($matches[1] as $url) {
                            $url = str_replace('&nbsp;', '', $url);
                            $request = \Request::create($url);
                            if ($this->isHostAllowed($request)) {
                                $route =
                                    \Route::getRoutes()
                                        ->match(
                                            $request
                                        )
                                        ->getName();
                                if (is_null($route)) {
                                    $this->info($comment['id'].'    '.$comment['content_id'].'      '.$matches[1][0]);
                                    $incorrectData[] = [
                                        'comment_id' => $comment['id'],
                                        'content_id' => $comment['content_id'],
                                        'url' => $matches[1][0],
                                        'decorated' => $decoratedComment['comment'],
                                    ];
                                }
                            }
                        }
                    }
                } else {
                    foreach ($decoratedComment['replies'] ?? [] as $reply) {
                        if ($reply['id'] == $comment['id'] &&
                            preg_match_all(self::HTML_HREF_REGEX_PATTERN, $reply['comment'], $matches)) {
                            foreach ($matches[1] as $url) {
                                $url = str_replace('&nbsp;', '', $url);

                                $request = \Request::create($url);
                                if ($this->isHostAllowed($request)) {
                                    $route =
                                        \Route::getRoutes()
                                            ->match(
                                                $request
                                            )
                                            ->getName();
                                    if (is_null($route)) {
                                        //  $this->info($reply['id'].'          '.$matches[1][0].'            '.$reply['comment']);
                                        $incorrectData[] = [
                                            'comment_id' => $reply['id'],
                                            'content_id' => $reply['content_id'],
                                            'url' => $matches[1][0],
                                            'decoratedReply' => $reply['comment'],
                                        ];
                                    }
                                }
                            }
                        }
                    }
                }
            }
        });
        $this->info('Incorrect nr: '.count($incorrectData));
        $this->info(print_r($incorrectData));
        $this->info("End verification ");
    }

    public function hasRelativeUrlsInComment($comment)
    {
        // Regular expression pattern to match URLs
        $pattern = '/href=["\']?((?:.(?!["\'?]))*.)["\'?]/';

        // Find all matches of URLs in the comment
        preg_match_all($pattern, $comment, $matches);

        // Iterate through the matched URLs
        foreach ($matches[1] as $url) {
            // Check if the URL is relative
            if (strpos($url, '/') === 0) {
                return true; // Relative URL found
            }
        }

        return false; // No relative URLs found
    }

    private function isHostAllowed($request)
    {
        $allowedHosts = [
            'www.drumeo.com',
            'www.pianote.com',
            'www.singeo.com',
            'www.guitareo.com',
            'forums.drumeo.com',
            'www.musora.com',
            'dev.musora.com',
        ];

        return in_array($request->getHttpHost(), $allowedHosts);
    }
}
