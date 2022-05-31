<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Support\Collection;
use Railroad\Railtracker\Repositories\MediaPlaybackRepository;

class ContentUserWatchPositionDecorator extends \Railroad\Railcontent\Decorators\ModeDecoratorBase
{
    /**
     * @var MediaPlaybackRepository
     */
    private $mediaPlaybackRepository;

    /**
     * CommentLikesDecorator constructor.
     */
    public function __construct(MediaPlaybackRepository $mediaPlaybackRepository)
    {
        $this->mediaPlaybackRepository = $mediaPlaybackRepository;
    }

    public function decorate(Collection $contents, $userId = null)
    {
        if (self::$decorationMode !== self::DECORATION_MODE_MAXIMUM) {
            return $contents;
        }

        if (empty($userId) && !empty(auth()->id())) {
            $userId = auth()->id();
        }

        if (empty($userId)) {
            return $contents;
        }

        $contentIds = [];

        foreach ($contents as $content) {
            $contentIds[] = $content['id'];
        }

        $contents = $contents->toArray();

        $vimeoIds = [];
        $youtubeIds = [];

        foreach ($contents as $content) {
            if (!empty($content->fetch('fields.video.fields.vimeo_video_id'))) {
                $vimeoIds[$content['id']] = $content->fetch('fields.video.fields.vimeo_video_id');
            }
            if (!empty($content->fetch('fields.video.fields.youtube_video_id'))) {
                $youtubeIds[$content['id']] = $content->fetch('fields.video.fields.youtube_video_id');
            }
        }

        if (!empty($vimeoIds)) {
            $playbackSessionsVimeo = $this->mediaPlaybackRepository->getCurrentSecondForLatestUserMediaSessions(
                'video',
                'vimeo',
                $vimeoIds,
                $userId
            );
        }
        if (!empty($youtubeIds)) {
            $playbackSessionsYoutube = $this->mediaPlaybackRepository->getCurrentSecondForLatestUserMediaSessions(
                'video',
                'youtube',
                $youtubeIds,
                $userId
            );
        }

        foreach ($contents as $index => $content) {

            if (array_key_exists($content['id'], $vimeoIds)) {

                if (!empty($content->fetch('fields.video.fields.vimeo_video_id')) &&
                    $content->fetch('completed') != true) {

                    $contents[$index]['last_watch_position_in_seconds'] =
                        (integer)($playbackSessionsVimeo[$content->fetch('fields.video.fields.vimeo_video_id')] ?? 0);
                } else {
                    $contents[$index]['last_watch_position_in_seconds'] = 0;
                }

            } elseif (array_key_exists($content['id'], $youtubeIds)) {

                if (!empty($content->fetch('fields.video.fields.youtube_video_id')) &&
                    $content->fetch('completed') != true) {

                    $contents[$index]['last_watch_position_in_seconds'] =
                        (integer)($playbackSessionsYoutube[$content->fetch('fields.video.fields.youtube_video_id')] ?? 0);
                } else {
                    $contents[$index]['last_watch_position_in_seconds'] = 0;
                }
            }
        }

        return new Collection($contents);
    }
}
