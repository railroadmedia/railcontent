<?php

namespace App\Modules\Content\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use DB;

class UpdateFirstItemThumbnailUrl extends Command
{
    protected $signature = 'update:first-item-thumbnail-url-playlists';
    protected $description = 'Update first_item_thumbnail_url on railcontent_user_playlists based on the first item thumbnail in railcontent_user_playlist_content';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Use a raw SQL update query similar to the MySQL script
        DB::statement("
            UPDATE railcontent_user_playlists AS playlists
            JOIN (
                SELECT
                    upc.user_playlist_id,
                    rcd.value AS first_thumbnail_url
                FROM
                    railcontent_user_playlist_content AS upc
                JOIN
                    railcontent_content_data AS rcd ON upc.content_id = rcd.content_id
                WHERE
                    upc.position = 1
                    AND rcd.key = 'thumbnail_url'
            ) AS first_items ON playlists.id = first_items.user_playlist_id
            SET
                playlists.first_item_thumbnail_url = first_items.first_thumbnail_url;
        ");

        $this->info('first_item_thumbnail_url has been updated for all playlists.');
    }
}
