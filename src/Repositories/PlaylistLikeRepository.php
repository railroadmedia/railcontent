<?php

namespace Railroad\Railcontent\Repositories;

class PlaylistLikeRepository extends RepositoryBase
{
    public function query()
    {
        return $this->connection()->table(config('railcontent.table_prefix').'playlist_likes');
    }
}