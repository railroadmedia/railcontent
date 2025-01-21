<?php

namespace Modules\UserManagementSystem\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthIfTokenExist
{
    /**
     * @param $request
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $all = $request->all();
        if (isset($all['token'])) {
            $request->headers->set('Authorization', sprintf('%s %s', 'Bearer', $all['token']));
        }
        return $next($request);
    }
}
