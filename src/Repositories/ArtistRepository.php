<?php

namespace Railroad\Railcontent\Repositories;


class ArtistRepository extends RepositoryBase
{
    public function query()
    {
        return $this->connection()->table('artists');
    }
}