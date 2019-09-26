<?php

namespace Railroad\Railcontent\Middleware;

use Closure;
use Illuminate\Http\Request;
use Railroad\Railcontent\Repositories\ContentRepository;


class NewDatabaseStructureMiddleware
{
    /**
     * Allows brand to be set on any request for the host installationg.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        ContentRepository::$version = 'new';

        return $next($request);
    }
}