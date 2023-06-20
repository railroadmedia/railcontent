<?php

namespace App\Decorators\Playlist;

use App\Decorators\Content\AddedToPrimaryPlaylistDecorator;
use Modules\UserManagementSystem\Models\User;
use Railroad\Railcontent\Decorators\Decorator;
use Railroad\Railcontent\Decorators\ModeDecoratorBase;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\PinnedPlaylistsRepository;
use Railroad\Railcontent\Repositories\UserPlaylistContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserPlaylistsService;
use Railroad\Railtracker\Services\ContentLastEngagedService;

class PlaylistDecorator extends ModeDecoratorBase
{

    private PinnedPlaylistsRepository $pinnedPlaylistsRepository;
    private UserPlaylistsService $userPlaylistsService;
    private ContentService $contentService;
    private ContentLastEngagedService $contentLastEngagedService;
    private UserPlaylistContentRepository $userPlaylistContentRepository;

    /**
     * @param PinnedPlaylistsRepository $pinnedPlaylistsRepository
     * @param UserPlaylistsService $userPlaylistsService
     */
    public function __construct(
        PinnedPlaylistsRepository $pinnedPlaylistsRepository,
        UserPlaylistsService $userPlaylistsService,
        ContentService $contentService,
        ContentLastEngagedService $contentLastEngagedService,
        UserPlaylistContentRepository  $userPlaylistContentRepository
    ) {
        $this->pinnedPlaylistsRepository = $pinnedPlaylistsRepository;
        $this->userPlaylistsService = $userPlaylistsService;
        $this->contentService = $contentService;
        $this->contentLastEngagedService = $contentLastEngagedService;
        $this->userPlaylistContentRepository = $userPlaylistContentRepository;
    }

    public function decorate($playlists)
    {
        $playlists = $playlists->toArray();
        $userIds = [];
        $playlistIds = [];
        ContentRepository::$bypassPermissions = true;

        foreach ($playlists as $index => $playlist) {
            $playlistIds[] = $playlist['id'];
            $userIds[] = $playlist['user_id'];
            $playlists[$index]['url'] =
                url()->route('platform.user.playlist', ["id" => $playlist['id'], "brand" => brand()]);
            if (!$playlist['thumbnail_url']) {
                $playlists[$index]['uploaded_thumbnail'] = false;
                $firstItem = $this->userPlaylistContentRepository->getFirstContentByPlaylistId($playlist['id']);
                if (isset($firstItem)) {
                    Decorator::$typeDecoratorsEnabled = false;
                    \Railroad\Railcontent\Decorators\Entity\AddedToPrimaryPlaylistDecorator::$skip = true;
                    ContentRepository::$pullFutureContent = true;
                    $oldStatuses = ContentRepository::$availableContentStatues;
                    $oldFutureContent = ContentRepository::$pullFutureContent;

                    ContentRepository::$availableContentStatues = [
                        ContentService::STATUS_PUBLISHED,
                        ContentService::STATUS_SCHEDULED,
                        ContentService::STATUS_ARCHIVED
                    ];

                    $firstItem = $this->contentService->getById($firstItem['content_id']);

                    $playlists[$index]['thumbnail_url'] = '';
                    if ($firstItem) {
                        $parent =
                            $this->contentService->getByChildId($firstItem['id'])
                                ->first();
                        Decorator::$typeDecoratorsEnabled = true;
                        $playlists[$index]['square_thumbnail'] =
                            (($firstItem['type'] == 'assignment' &&
                                    ($firstItem->fetch('parent')) &&
                                    in_array($firstItem->fetch('parent')['type'], ['song', 'song-tutorial-children']
                                    )) ||
                                $firstItem['type'] == 'song-tutorial-children' ||
                                $firstItem['type'] == 'song' ||
                                $firstItem['type'] == 'routine');

                        $playlists[$index]['thumbnail_url'] = $firstItem->fetch(
                            'data.thumbnail_url',
                            ($parent) ? $parent->fetch('data.original_thumbnail_url') : ''
                        );
                    }

                    ContentRepository::$availableContentStatues = $oldStatuses;
                    ContentRepository::$pullFutureContent = $oldFutureContent;
                }
            } else {
                $playlists[$index]['uploaded_thumbnail'] = true;
            }

            $minsec = gmdate("i:s", $playlists[$index]['duration'] ?? 0);
            $hours = (gmdate("d", $playlists[$index]['duration'] ?? 0)-1)*24 + gmdate("H", $playlists[$index]['duration'] ?? 0);
            $playlists[$index]['duration_formated'] = ($hours == 0)? $minsec : $hours.':'.$minsec ;

            $playlists[$index]['playback_url'] = url()->route('platform.play.playlist', [
                'playlistId' => $playlist['id'],
            ]);

            $playlists[$index]['description'] = ($playlist['description']) ? $playlist['description'] : ' ';
        }

        $userIds = array_unique($userIds);

        /**
         * @var $users User[]
         */
        $users =
            User::query()
                ->whereIn('id', $userIds)
                ->get();

        $keyedUsers = [];

        foreach ($users as $userIndex => $user) {
            $keyedUsers[$user->id] = $user;
        }

        foreach ($playlists as $index => $playlist) {
            if (!isset($keyedUsers[$playlist['user_id']])) {
                unset($playlists[$index]);

                continue;
            }

            /**
             * @var $user User
             */
            $playlistAuthor = $keyedUsers[$playlist['user_id']];
            $playlists[$index]['is_my_playlist'] = user() ? (($playlist['user_id'] == user()->id) ? 1 : 0) : 0;
            $playlists[$index]['user'] = [];
            $playlists[$index]['user']['id'] = $playlistAuthor['id'];
            $playlists[$index]['user']['display_name'] = $playlistAuthor['display_name'];
            $playlists[$index]['user']['fields.profile_picture_image_url'] = $playlistAuthor['profile_picture_url'];
        }
        ContentRepository::$bypassPermissions = false;

        if (self::$decorationMode !== self::DECORATION_MODE_MAXIMUM) {
            return $playlists;
        }

        $completedItems = $this->userPlaylistsService->countCompletedUserPlaylistContents(
            $playlistIds
        );

        $startedItems = $this->userPlaylistsService->countStartedUserPlaylistContents(
            $playlistIds
        );

        $totalItems = $this->userPlaylistsService->countUserPlaylistItems(
            $playlistIds
        );

        foreach ($playlists as $index => $playlist) {
            $playlists[$index]['progress_percent'] = 0;
            $playlists[$index]['completed_items'] = $completedItems[$playlist['id']] ?? 0;
            $playlists[$index]['started_items'] = $startedItems[$playlist['id']] ?? 0;
            $playlists[$index]['total_items'] = $totalItems[$playlist['id']] ?? 0;
            $playlists[$index]['state'] =
                ($playlists[$index]['completed_items'] > 0 || $playlists[$index]['started_items'] > 0) ? 'started' :
                    (($playlists[$index]['completed_items'] == $playlists[$index]['total_items']) ? 'completed' : '');
            if($playlists[$index]['total_items'] > 0){
                $playlists[$index]['progress_percent'] = $playlists[$index]['completed_items']/$playlists[$index]['total_items'];
            }
        }

        return $playlists;
    }
}
