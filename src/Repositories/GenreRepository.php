<?php

namespace Railroad\Railcontent\Repositories;


class GenreRepository extends RepositoryBase
{
    public function query()
    {
        return $this->connection()->table('genre');
    }
}