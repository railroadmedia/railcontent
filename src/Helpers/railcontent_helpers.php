<?php

use Illuminate\Support\Facades\DB;

if (! function_exists('rawQuery')) {
    function rawQuery($query): string
    {
        return DB::raw($query)
            ->getValue(DB::connection(config('railcontent.database_connection_name'))->getQueryGrammar());
    }
}