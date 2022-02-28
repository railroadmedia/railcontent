<?php

namespace Railroad\Railcontent\Faker;

use Carbon\Carbon;
use Faker\Generator;


class Faker extends Generator
{
    public function permission(array $override = [])
    {
        return array_merge(
            [
                'name' => $this->word,
                'brand' => config('railcontent.brand'),
            ],
            $override
        );
    }

    public function userPermission(array $override = [])
    {
        return array_merge(
            [
                'user_id' => $this->randomNumber(),
                'permission_id' => $this->randomNumber(),
                'start_date' =>Carbon::now()
                    ->toDateTimeString(),
           'expiration_date' => null,
                'created_at' => Carbon::now()
                    ->toDateTimeString(),
                'updated_at' => null
            ],
            $override
        );
    }

    public function contentPermission(array $override = [])
    {
        return array_merge(
            [
                'content_id' => $this->randomNumber(),
                'content_type' => $this->word(),
                'permission_id' => $this->randomNumber(),
                'brand' => config('railcontent.brand'),
            ],
            $override
        );
    }

    public function contentHierarchy(array $override = [])
    {
        return array_merge(
            [
                'parent_id' => $this->randomNumber(),
                'child_id' => $this->randomNumber(),
                'child_position' => $this->randomNumber(),
                'created_on' =>Carbon::now(),
            ],
            $override
        );
    }

    public function comment(array $override = [])
    {
        return array_merge(
            [
                'content_id' => $this->randomNumber(),
                'parent_id' => $this->randomNumber(),
                'user_id' => $this->randomNumber(),
                'comment' => $this->paragraph(),
                'temporary_display_name' => $this->word,
                'created_on' =>Carbon::now(),
            ],
            $override
        );
    }

    public function commentLike(array $override = [])
    {
        return array_merge(
            [
                'comment_id' => $this->randomNumber(),
                'user_id' => $this->randomNumber(),
                'created_on' =>Carbon::now(),
            ],
            $override
        );
    }

    public function contentTopic(array $override = [])
    {
        return array_merge(
            [
                'content_id' => $this->randomNumber(),
                'topic' => $this->word(),
                'position' => $this->randomNumber(),
            ],
            $override
        );
    }

    public function contentData(array $override = [])
    {
        return array_merge(
            [
                'content_id' => $this->randomNumber(),
                'key' => $this->word,
                'value' => $this->word,
                'position' => $this->randomNumber(2),
            ],
            $override
        );
    }

    public function contentLike(array $override = [])
    {
        return array_merge(
            [
                'content_id' => $this->randomNumber(),
                'user_id' => $this->randomNumber(),
                'created_on' =>Carbon::now(),
            ],
            $override
        );
    }

    public function contentInstructor(array $override = [])
    {
        return array_merge(
            [
                'content_id' => $this->randomNumber(),
                'instructor_id' => $this->randomNumber(),
                'position' => $this->randomNumber(),
            ],
            $override
        );
    }

    public function userContentProgress(array $override = [])
    {
        return array_merge(
            [
                'content_id' => $this->randomNumber(),
                'user_id' => $this->randomNumber(),
                'state' => 'started',
                'progressPercent' => $this->randomNumber(2),
                'higherKeyProgress' => null,
                'updatedOn' => Carbon::now()
            ],
            $override
        );
    }

    public function userPlaylist(array $override = [])
    {
        return array_merge(
            [
                'brand' => config('railcontent.brand'),
                'user_id' => $this->randomNumber(),
                'type' => 'primary-playlist',
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            $override
        );
    }

    public function userPlaylistContent(array $override = [])
    {
        return array_merge(
            [
                'content_id' => $this->randomNumber(),
                'user_playlist_id' => $this->randomNumber(),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => null
            ],
            $override
        );
    }

    public function contentStatistics(array $override = [])
    {
        return array_merge(
            [
                'content_id' => $this->randomNumber(),
                'content_type' => $this->word(),
                'content_published_on' => Carbon::now()->toDateTimeString(),
                'completes' => $this->randomNumber(),
                'starts' => $this->randomNumber(),
                'comments' => $this->randomNumber(),
                'likes' => $this->randomNumber(),
                'added_to_list' => $this->randomNumber(),
                'start_interval' => Carbon::now()->toDateTimeString(),
                'end_interval' => Carbon::now()->toDateTimeString(),
                'week_of_year' => $this->randomNumber(),
                'created_on' => Carbon::now()->toDateTimeString(),
            ],
            $override
        );
    }


    public function content(array $override = [])
    {
        return array_merge(
            [
                'slug' => $this->slug(),
                'type' => $this->word,
                'status' => $this->word,
                'brand' => config('railcontent.brand'),
                'title' => $this->word,
                'published_on' => Carbon::now()->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
            ],
            $override
        );
    }

    public function contentStyle(array $override = [])
    {
        return array_merge(
            [
                'content_id' => $this->randomNumber(),
                'style' => $this->word(),
                'position' => $this->randomNumber(),
            ],
            $override
        );
    }

    public function contentFollow(array $override = [])
    {
        return array_merge(
            [
                'content_id' => $this->randomNumber(),
                'user_id' => $this->randomNumber(),
                'created_on' => Carbon::now()
            ],
            $override
        );
    }
}