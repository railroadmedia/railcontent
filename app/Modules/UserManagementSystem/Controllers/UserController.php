<?php

namespace Modules\UserManagementSystem\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use ReflectionException;

class UserController extends Controller
{
    use AuthorizesRequests;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware([ConvertEmptyStringsToNull::class]);
    }

    /**
     * @return RedirectResponse
     * @throws ReflectionException
     */
    public function create(Request $request)
    {
        // todo
        $this->authorize('users.create');
    }

    /**
     * @return RedirectResponse
     * @throws ReflectionException
     */
    public function read(Request $request, $id)
    {
        // todo
        $this->authorize('users.read');
    }

    /**
     * @param integer $id
     * @return RedirectResponse
     * @throws ReflectionException
     */
    public function update(Request $request, $id)
    {
        // todo
        $this->authorize('users.update');
    }

    /**
     * @param Request $request
     * @param integer $id
     * @return RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        // todo
        $this->authorize('users.destroy');
    }
}
