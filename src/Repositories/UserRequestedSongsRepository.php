<?php

namespace Railroad\Railcontent\Repositories;

class UserRequestedSongsRepository extends RepositoryBase
{
    public function query()
    {
        return $this->connection()->table(config('railcontent.table_prefix').'user_requested_songs');
    }
}