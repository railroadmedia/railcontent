<?php

namespace Modules\UserManagementSystem\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use Modules\UserManagementSystem\Events\User\UserUpdated;
use Modules\UserManagementSystem\Models\User;
use Psy\Util\Json;
use ReflectionException;
use Modules\UserManagementSystem\Events\User\UserCreated;
use Modules\UserManagementSystem\Events\User\UserDeleted;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class UserController extends Controller
{
    use ValidatesRequests;
    use AuthorizesRequests;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware([ConvertEmptyStringsToNull::class]);
    }


    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $isJson = request()->expectsJson();
        $this->authorize('create-users');

        try {
            $validationRules = [
            //todo: make email and display_name unique
                'email' => 'required|email|max:255',
                'password' => 'required|string|min:8|max:128',
                'display_name' => 'required|string|max:64|min:2'
            ];

            $this->validate(
                $request,
                $validationRules
            );
        } catch (ValidationException $exception) {
            if ($isJson) {
                return json_encode(
                    array(
                        "status" => "error",
                        "errors" => json_encode($exception->errors())
                    )
                );
            }


            return $request->has('redirect') ?
                redirect()
                    ->away($request->get('redirect'))
                    ->with($exception->errors()) :
                redirect()
                    ->back()
                    ->with($exception->errors());
        }

        $user = new User;

        $user->email = $request->email;
        $user->setPassword($request->password);
        $user->display_name = $request->display_name;
        $user->save();

        $newUser = User::where('email', $user->email)->first();;

        event(new UserCreated($user));

        if (!$isJson) {
            $message = ['success' => true];

            return $request->has('redirect') ?
                redirect()
                    ->away($request->get('redirect'))
                    ->with($message) :
                redirect()
                    ->back()
                    ->with($message);
        } else {
            return json_encode(
                array(
                    "data" =>
                        array("attributes" => json_encode($user))
                )
            );
        }
    }

    /**
     * @param Request $request
     * @param integer $id
     */
    public function read(Request $request, $id)
    {
        $this->authorize('show-users');
        $user = User::findOrFail($id);

        if ($user) {
            return json_encode(
                array(
                    "data" =>
                        array("attributes" => json_encode($user))
                )
            );
        } else {
            throw new NotFoundHttpException();
        }


    }

    /**
     * @param Request $request
     * @param integer $id
     */
    public function update(Request $request, $id)
    {
        $isJson = request()->expectsJson();
        $this->authorize('update-users');

        try {
            $validationRules = [
                //todo: make email and display_name unique
                'email' => 'required|email|max:255',
                'display_name' => 'required|string|max:64|min:2'
            ];

            $this->validate(
                $request,
                $validationRules
            );
        } catch (ValidationException $exception) {
            if ($isJson) {
                return json_encode(
                    array(
                        "status" => "error",
                        "errors" => json_encode($exception->errors())
                    )
                );
            }


            return $request->has('redirect') ?
                redirect()
                    ->away($request->get('redirect'))
                    ->with($exception->errors()) :
                redirect()
                    ->back()
                    ->with($exception->errors());
        }

        $user = User::findOrFail($id);

        if ($user) {
            $oldUser = clone($user);

            $user->email = $request->email;
            $user->display_name = $request->display_name;
            $user->save();

            event(new UserUpdated($user, $oldUser));
        }


        if (!$isJson) {
            $message = ['success' => true];

            return $request->has('redirect') ?
                redirect()
                    ->away($request->get('redirect'))
                    ->with($message) :
                redirect()
                    ->back()
                    ->with($message);
        } else {
            return json_encode(
                array(
                    "data" =>
                        array("attributes" => json_encode($user))
                )
            );
        }
    }

    /**
     * @param Request $request
     * @param integer $id
     */
    public function destroy(Request $request, $id)
    {
        $isJson = request()->expectsJson();

        $this->authorize('delete-users');

        $user = User::findOrFail($id);
        if ($user) {
            $user->delete();
            event(new UserDeleted($user));

        }

        if (!$isJson) {
            $message = ['success' => true];

            return $request->has('redirect') ?
                redirect()
                    ->away($request->get('redirect'))
                    ->with($message) :
                redirect()
                    ->back()
                    ->with($message);
        } else {
            return json_encode(
                array(
                    "data" =>
                        array("attributes" => json_encode($user))
                )
            );
        }
    }



    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
        $this->authorize('index-users');

        $searchTerm = $request->get('search_term');

        $users = User::query()
            ->where('displayName', 'LIKE', "%{$searchTerm}%")
            ->orWhere('email', 'LIKE', "%{$searchTerm}%")
            ->orWhere('firstName', 'LIKE', "%{$searchTerm}%")
            ->orWhere('lastName', 'LIKE', "%{$searchTerm}%")
            ->orWhere('phoneNumber', 'LIKE', "%{$searchTerm}%")
            ->limit($request->get('per_page', 25))
            ->orderBy($request->get('sort', 'createdAt'))
            ->get();


        return json_encode(
            array(
                "data" => json_encode($users)
            )
        );

    }
}
