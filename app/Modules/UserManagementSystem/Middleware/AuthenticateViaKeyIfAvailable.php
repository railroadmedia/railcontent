<?php

namespace Modules\UserManagementSystem\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\UserManagementSystem\Events\UserEvent;
use Modules\UserManagementSystem\Models\User;

class AuthenticateViaKeyIfAvailable
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $remember = false;

        if (config('user_management_system.force_remember', false) == true ||
            (boolean)$request->get('remember', false) == true) {
            $remember = true;
        }

        $request->attributes->set('remember', $remember);

        $userId = $request->get('user_id', '');
        $key = $request->get('auth_key', '');

        if (empty($userId) || empty($key)) {
            return $next($request);
        }

        $user = User::query()->findOrFail($userId);
        $passedCheck = false;
        $i = 0;

        // key expires after 2 minutes
        while ($i < 2) {
            $hash = md5($user->id . $user->password . Carbon::now()->startOfMinute()->subMinutes($i)->toDateTimeString());

            if ($hash === $key) {
                $passedCheck = true;
                break;
            }

            $i++;
        }

        if ($passedCheck) {
            auth()->login($user, $remember);

            event(new UserEvent($user->id, 'authenticated'));
        }

        return $next($request);
    }
}
