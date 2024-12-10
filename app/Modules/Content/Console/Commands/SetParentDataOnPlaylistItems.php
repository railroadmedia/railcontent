<?php

namespace App\Modules\Content\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use DB;

class SetParentDataOnPlaylistItems extends Command
{
    protected $signature = 'update:parent-data-playlist-item';
    protected $description = 'Set content_parent on railcontent_user_playlist_content';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        DB::statement("
             UPDATE railcontent_user_playlist_content rpc
JOIN railcontent_content rc ON rpc.content_id = rc.id
SET rpc.content_parent = JSON_UNQUOTE(
    JSON_EXTRACT(
        rc.parent_content_data,
        CONCAT('$[', JSON_LENGTH(rc.parent_content_data) - 1, '].id')
    )
)
WHERE rc.parent_content_data IS NOT NULL AND JSON_LENGTH(rc.parent_content_data) > 0;
        ");

        $this->info('content_parent has been updated');
    }
}
