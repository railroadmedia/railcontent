<?php

namespace App\Decorators\Content;

use Illuminate\Database\ConnectionInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Railroad\Railcontent\Decorators\Decorator;
use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Support\Collection;

class PlaylistItemDecorator extends TypeDecoratorBase
{
    private static $parents = [];
    private static $noAccessMessages = [];

    /**
     * @param Collection $contents
     * @return mixed|Collection
     */
    public function decorate(Collection $contents)
    {
        $contentsOfType = $contents->whereNotNull('user_playlist_item_id');

        if ($contentsOfType->isEmpty()) {
            return $contents;
        }
        $contentIds = \Arr::pluck($contentsOfType, 'id');

        $hierarchyRows =
            $this->contentRepository->query()
                ->from(config('railcontent.table_prefix').'content_hierarchy as rch1')
                ->leftJoin(
                    config('railcontent.table_prefix').'content as rcp1',
                    'rcp1.id',
                    '=',
                    'rch1.parent_id'
                )
                ->leftJoin(
                    config('railcontent.table_prefix').'content_hierarchy as rch2',
                    'rch2.child_id',
                    '=',
                    'rch1.parent_id'
                )
                ->leftJoin(
                    config('railcontent.table_prefix').'content as rcp2',
                    'rcp2.id',
                    '=',
                    'rch2.parent_id'
                )
                ->leftJoin(
                    config('railcontent.table_prefix').'content_hierarchy as rch3',
                    'rch3.child_id',
                    '=',
                    'rch2.parent_id'
                )
                ->leftJoin(
                    config('railcontent.table_prefix').'content as rcp3',
                    'rcp3.id',
                    '=',
                    'rch3.parent_id'
                )
                ->leftJoin(
                    config('railcontent.table_prefix').'content_hierarchy as rch4',
                    'rch4.child_id',
                    '=',
                    'rch3.parent_id'
                )
                ->leftJoin(
                    config('railcontent.table_prefix').'content as rcp4',
                    'rcp4.id',
                    '=',
                    'rch4.parent_id'
                )
                ->select([
                             'rch1.child_id as rch1_child_id',
                             'rch1.parent_id as rch1_parent_id',
                             'rch1.child_position as rch1_child_position',
                             'rcp1.id as rcp1_content_id',
                             'rcp1.title as rcp1_content_title',
                             'rcp1.type as rcp1_content_type',
                             'rch2.child_id as rch2_child_id',
                             'rch2.parent_id as rch2_parent_id',
                             'rch2.child_position as rch2_child_position',
                             'rcp2.id as rcp2_content_id',
                             'rcp2.title as rcp2_content_title',
                             'rcp2.type as rcp2_content_type',
                             'rch3.child_id as rch3_child_id',
                             'rch3.parent_id as rch3_parent_id',
                             'rch3.child_position as rch3_child_position',
                             'rcp3.id as rcp3_content_id',
                             'rcp3.title as rcp3_content_title',
                             'rcp3.type as rcp3_content_type',
                             'rch4.child_id as rch4_child_id',
                             'rch4.parent_id as rch4_parent_id',
                             'rch4.child_position as rch4_child_position',
                             'rcp4.id as rcp4_content_id',
                             'rcp4.title as rcp4_content_title',
                             'rcp4.type as rcp4_content_type',
                         ])
                ->whereIn('rch1.child_id', $contentIds)
                ->get();

        $contentPermissionRows = collect(
            $this->contentPermissionRepository->getByContentIdsOrTypes(
                $contentIds,
                \Arr::pluck($contentsOfType, 'type')
            )
        );
        $grupedPermissions = $contentPermissionRows->groupBy('content_id');
        $userPermissions = $this->userPermissionsRepository->getUserPermissions(user()->id, true);

        foreach ($contentsOfType as $contentIndex => $content) {
            $resources = [];
            foreach ($content['resources'] ?? [] as $resource) {
                $resources[$resource['resource_url']] = $resource;
            }
            if(!config('musora-api.api.version') || config('musora-api.api.version') != 'v1') {
                $contentsOfType[$contentIndex]['type'] = $this->convertContentType($content['type']);
            }

            //set start/end time should not be displayed on assignments and song playlist items
            $contentsOfType[$contentIndex]['content_name'] =
                $content['content_name'] ?? null;
            $contentsOfType[$contentIndex]['playlist_item_name'] =
                $content['playlist_item_name'] ?? null;

            $contentsOfType[$contentIndex]['set_start_end_time'] =
                ($content['type'] != 'assignment' && $content['type'] != 'song');
            $contentsOfType[$contentIndex]['user_playlist_item_extra_data'] =
                $content['user_playlist_item_extra_data'] ?? null;
            $contentsOfType[$contentIndex]['duration'] = $contentsOfType[$contentIndex]['length_in_seconds'] = $content->fetch('fields.length_in_seconds', $content->fetch('fields.video.fields.length_in_seconds', 0));

            $userPlaylistId =
                $content['user_playlist_id']
                ??
                $this->userPlaylistContentRepository->getById($content['user_playlist_item_id'])['user_playlist_id'];

            $contentsOfType[$contentIndex]['url'] = url()->route('platform.user.playlist-item', [
                'playlistId' => $userPlaylistId,
                'playlistItemId' => $content['user_playlist_item_id'],
            ]);

            $userPermissionIds = \Arr::pluck($userPermissions, 'permission_id');
            $membershipPermissionIds = [1, 52, 73, 77,];
            if (!empty(array_intersect($userPermissionIds, $membershipPermissionIds))) {
                $userPermissionIds = array_merge($userPermissionIds, $membershipPermissionIds);
            }

            $contentsOfType[$contentIndex]['need_access'] = empty(
                array_intersect(
                    $userPermissionIds,
                    (isset($grupedPermissions[$content['id']])) ?
                        $grupedPermissions[$content['id']]->pluck('permission_id')
                            ->toArray() : []
                )
            ) && (isset($grupedPermissions[$content['id']]));

            $needLifetime = (count($grupedPermissions[$content['id']] ?? []) == 1) && array_intersect(
                [
                        'Drumeo Lifetime Member',
                        'Pianote Lifetime Member',
                        'Guitareo Lifetime Member',
                        'Singeo Lifetime Member',
                    ],
                (isset($grupedPermissions[$content['id']])) ?
                        $grupedPermissions[$content['id']]->pluck('name')
                            ->toArray() : []
            );
            $needMusoraBasic = array_intersect(
                ['Musora Basic Membership'],
                (isset($grupedPermissions[$content['id']])) ?
                    $grupedPermissions[$content['id']]->pluck('name')
                        ->toArray() : []
            );

            $message = '';
            if (!empty($needLifetime)) {
                $message = 'This Masterclass is part of our exclusive <b>Lifetime Membership</b>.';
                self::$noAccessMessages[$content['id']] = $message;
            } elseif (!empty($needMusoraBasic)) {
                $message = 'This lesson is part of our <b>Musora Membership</b>.';
                self::$noAccessMessages[$content['id']] = $message;
            } elseif ($content['type'] == 'song' && !user()->hasSongsAccess($content['brand'])) {
                $contentsOfType[$contentIndex]['need_access'] = true;
                $message = 'This Song content is part of our <b>Musora+ Membership</b>.';
                self::$noAccessMessages[$content['id']] = $message;
            }

            if ($contentsOfType[$contentIndex]['need_access']) {
                $contentsOfType[$contentIndex]['need_access_message'] = $message;
            }

            if(ContentRepository::$bypassPermissions === true) {
                $contentsOfType[$contentIndex]['need_access'] = false;
                $contentsOfType[$contentIndex]['need_access_message'] = '';
            }
            if (!empty($content['user_playlist_item_extra_data'])) {
                if ((is_null(json_decode($content['user_playlist_item_extra_data'])))) {
                    error_log($content['user_playlist_item_extra_data']);
                }
                foreach (json_decode($content['user_playlist_item_extra_data'], true) ?? [] as $key => $value) {
                    $contentsOfType[$contentIndex][$key] = $value;
                }
            }

            //thumbnail_url
            $contentsOfType[$contentIndex]['thumbnail_url'] =
                $content->fetch('data.original_thumbnail_url', $content->fetch('data.thumbnail_url'));

            $route = [];
            $parentContentDataForDatabase = [];
            if (!empty($content['parent_content_data'])) {
                $hierarchyData =
                    $hierarchyRows->where('rch1_child_id', $content['id'])
                        ->first();
                if (!empty($hierarchyData)) {
                    if (!empty($hierarchyData['rch4_parent_id']) &&
                        !empty($hierarchyData['rcp4_content_id']) &&
                        !empty($hierarchyData['rcp4_content_title'])) {
                        $parentContentDataForDatabase[] = (object)[
                            'id' => $hierarchyData['rcp4_content_id'],
                            'title' => $hierarchyData['rcp4_content_title'],
                            'type' => $hierarchyData['rcp4_content_type'],
                            'position' => null,
                        ];
                    }

                    if (!empty($hierarchyData['rch3_parent_id']) &&
                        !empty($hierarchyData['rcp3_content_id']) &&
                        !empty($hierarchyData['rcp3_content_title'])) {
                        $parentContentDataForDatabase[] = (object)[
                            'id' => $hierarchyData['rcp3_content_id'],
                            'title' => $hierarchyData['rcp3_content_title'],
                            'type' => $hierarchyData['rcp3_content_type'],
                            'position' => $hierarchyData['rch4_child_position'],
                        ];
                    }

                    if (!empty($hierarchyData['rch2_parent_id']) &&
                        !empty($hierarchyData['rcp2_content_id']) &&
                        !empty($hierarchyData['rcp2_content_title'])) {
                        $parentContentDataForDatabase[] = (object)[
                            'id' => $hierarchyData['rcp2_content_id'],
                            'title' => $hierarchyData['rcp2_content_title'],
                            'type' => $hierarchyData['rcp2_content_type'],
                            'position' => $hierarchyData['rch3_child_position'],
                        ];
                    }

                    if (!empty($hierarchyData['rch1_parent_id']) &&
                        !empty($hierarchyData['rcp1_content_id']) &&
                        !empty($hierarchyData['rcp1_content_title'])) {
                        $parentContentDataForDatabase[] = (object)[
                            'id' => $hierarchyData['rcp1_content_id'],
                            'title' => $hierarchyData['rcp1_content_title'],
                            'type' => $hierarchyData['rcp1_content_type'],
                            'position' => $hierarchyData['rch2_child_position'],
                        ];
                    }
                }
                $childId = $content['id'];
                foreach (array_reverse($parentContentDataForDatabase) as $parent) {
                    switch ($parent->type) {
                        case 'learning-path':
                            $route[] = 'Method';
                            break;
                        case 'learning-path-level':
                            $route[] = 'L' . $parent->position;
                            break;
                        case 'song':
                            break;
                        case 'play-along':
                            break;
                        case 'edge-pack':
                            break;
                        default:
                            $route[] = $parent->title ?? '';
                            break;
                    }

                    if (isset($parent) && (!isset(self::$parents[$childId]))) {
                        Decorator::$typeDecoratorsEnabled = true;
                        \Railroad\Railcontent\Decorators\Entity\AddedToPrimaryPlaylistDecorator::$skip = true;
                        AddedToPrimaryPlaylistDecorator::$skip = true;
                        $initialByPassPermission = ContentRepository::$bypassPermissions;
                        $initialPullFutureContent = ContentRepository::$pullFutureContent;
                        ContentRepository::$bypassPermissions = true;
                        ContentRepository::$pullFutureContent = true;
                        ResourceDecorator::$decorationMode = \Railroad\Railcontent\Decorators\ModeDecoratorBase::DECORATION_MODE_MAXIMUM;

                        $parentContent[$childId] =
                            $this->contentService->getByIds([$parent->id])
                                ->first();
                        ContentRepository::$bypassPermissions = $initialByPassPermission;
                        ContentRepository::$pullFutureContent = $initialPullFutureContent;
                        self::$parents = $parentContent + self::$parents;
                        Decorator::$typeDecoratorsEnabled = true;
                    }

                    if (isset(self::$parents[$childId]) &&
                        (self::$parents[$childId] instanceof ContentEntity)) {

                        $contentsOfType[$contentIndex]['parent'] = self::$parents[$childId] ?? null;
                        $contentsOfType[$contentIndex]['parent_title'] = self::$parents[$childId]['title'] ?? null;
                        $contentsOfType[$contentIndex]['parent'] = $this->resourceDecorator->decorate(new Collection([self::$parents[$childId]]))
                            ->first();

                        foreach ($contentsOfType[$contentIndex]['parent']['resources'] ?? [] as $parentResource) {
                            $resources[$parentResource['resource_url']] = $parentResource;
                        }
                        if (empty($contentsOfType[$contentIndex]['instructors'])) {
                            InstructorDecorator::$decorationMode =
                                \Railroad\Railcontent\Decorators\ModeDecoratorBase::DECORATION_MODE_MINIMUM;
                            self::$parents[$childId] =
                                $this->instructorDecorator->decorate(new Collection([self::$parents[$childId]]))
                                    ->first();
                            $contentsOfType[$contentIndex]['instructors'] =
                                self::$parents[$childId]['instructors'] ?? [];
                        }
                        if (empty($contentsOfType[$contentIndex]['thumbnail_url'])) {
                            $contentsOfType[$contentIndex]['thumbnail_url'] = self::$parents[$childId]->fetch(
                                'data.original_thumbnail_url',
                                self::$parents[$childId]->fetch('data.thumbnail_url')
                            );
                            if (empty($contentsOfType[$contentIndex]['thumbnail_url']) &&
                                isset(self::$parents[(self::$parents[$childId]['id'])])) {
                                $contentsOfType[$contentIndex]['thumbnail_url'] =
                                    self::$parents[(self::$parents[$childId]['id'])]->fetch(
                                        'data.original_thumbnail_url'
                                    );
                            }
                        }

                        if ($contentsOfType[$contentIndex]['need_access'] &&
                            (empty($contentsOfType[$contentIndex]['need_access_message']))) {
                            $parent = self::$parents[$childId] ?? null;
                            $contentsOfType[$contentIndex]['need_access_message'] =
                            self::$noAccessMessages[$childId] =
                                $content['title'] . ' is part of our <b>' . $parent['title'] . '</b> Pack.';
                        }

                        if ($content['type'] == 'assignment') {
                            // TODO: check how to get the assignment duration
                            $contentsOfType[$contentIndex]['fields'] =
                                array_merge($content['fields'] ?? [], self::$parents[$childId]['fields'] ?? []);

                            $contentsOfType[$contentIndex]['need_access'] = empty(
                                array_intersect(
                                    $userPermissionIds,
                                    (isset($grupedPermissions[self::$parents[$childId]['id']])) ?
                                        $grupedPermissions[self::$parents[$childId]['id']]->pluck('permission_id')
                                            ->toArray() : []
                                )
                            ) && (isset($grupedPermissions[self::$parents[$childId]['id']]));
                            if ($contentsOfType[$contentIndex]['need_access']) {
                                $contentsOfType[$contentIndex]['need_access_message'] =
                                    self::$noAccessMessages[self::$parents[$childId]['id']] ?? '';
                            }
                        }
                    }
                    $childId = $parent->id;
                }
            }

            $contentsOfType[$contentIndex]['route'] = array_reverse($route);

            foreach(array_reverse($parentContentDataForDatabase) as $parent) {
                foreach (self::$parents[$parent->id]['resources'] ?? [] as $parentResource) {
                    $resources[$parentResource['resource_url']] = $parentResource;
                }
            }

            $contentsOfType[$contentIndex]['resources'] = array_values($resources);
        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }

    /**
     * @return ConnectionInterface
     */
    private function railcontentDB()
    {
        return DB::connection(config('railcontent.database_connection_name'));
    }

    private function convertContentType($contentType)
    {
        $modifiedType = $contentType;

        if ($contentType === 'learning-path-lesson') {
            return 'Method Lesson';
        }
        if ($contentType === 'song-tutorial-children') {
            return 'Song Tutorial';
        }
        if ($contentType === 'play-along') {
            return 'Play-Along';
        }

        try {
            $modifiedType = str_replace('-', ' ', $contentType);
        } catch (e) {
            return '';
        }

        return $modifiedType;
    }
}
