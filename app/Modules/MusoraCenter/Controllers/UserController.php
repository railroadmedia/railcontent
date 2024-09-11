<?php

namespace App\Modules\MusoraCenter\Controllers;

use App\Modules\CustomerIO\Services\CustomerIoService;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\UserManagementSystem\Events\User\UserUpdated;
use Modules\UserManagementSystem\Models\User;
use Railroad\Permissions\Services\PermissionService;
use Railroad\Usora\Requests\UserJsonUpdateRequest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private CustomerIoService $customerIoService,
        private PermissionService $permissionService,
        private Hasher $hasher
    ) {
    }

    public function update(UserJsonUpdateRequest $request, User $user)
    {
        $authorized = $this->permissionService->can(Auth::id(), 'update-users');
        if (!$authorized && auth()->id() !== $user->id) {
            throw new NotFoundHttpException();
        }

        $attributes = [];

        if (!empty($request->input('data.attributes.display_name'))) {
            $attributes['display_name'] = $request->input('data.attributes.display_name');
        }

        if ($authorized && !empty($request->input('data.attributes.email'))) {
            $attributes['email'] = $request->input('data.attributes.email');
        }

        if ($authorized && !empty($request->input('data.attributes.password'))) {
            $attributes['password'] = $this->hasher->make($request->input('data.attributes.password'));
        }

        if ($attributes) {
            $oldUser = clone ($user);

            $user->fill($attributes);
            $user->save();

            event(new UserUpdated($user, $oldUser));
        }

        return response()->json($user);
    }
}
