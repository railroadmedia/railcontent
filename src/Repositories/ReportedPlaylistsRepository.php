<?php

namespace Railroad\Railcontent\Repositories;


class ReportedPlaylistsRepository extends RepositoryBase
{
    /**
     * @return \Illuminate\Database\Query\Builder
     */
    public function query()
    {
        return $this->connection()->table(config('railcontent.table_prefix').'reported_playlists');
    }
}