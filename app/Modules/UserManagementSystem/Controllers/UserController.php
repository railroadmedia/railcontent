<?php

namespace Modules\UserManagementSystem\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use ReflectionException;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
    public function store(Request $request)
    {
        $this->authorize('users.create');

        return 'yes';
    }

//    /**
//     * @param UserUpdateRequest $request
//     * @param integer $id
//     * @return RedirectResponse
//     * @throws DBALException
//     * @throws ORMException
//     * @throws OptimisticLockException
//     * @throws ReflectionException
//     */
//    public function update(UserUpdateRequest $request, $id)
//    {
//        if (!$this->permissionService->can(auth()->id(), 'update-users') && auth()->id() != $id) {
//            throw new NotFoundHttpException();
//        }
//
//        $user = $this->userRepository->find($id);
//        $oldUser = clone($user);
//
//        if (empty($user)) {
//            throw new NotFoundHttpException();
//        }
//
//        $this->arrayHydrator->hydrate($user, $request->onlyAllowed());
//
//        // regular users are not allowed to change their emails here
//        if ($this->permissionService->can(auth()->id(), 'update-users-email-without-confirmation') &&
//            !empty($request->input('data.attributes.email'))) {
//
//            $user->setEmail($request->input('data.attributes.email'));
//        }
//
//        $this->entityManager->persist($user);
//        $this->entityManager->flush();
//
//        event(new UserUpdated($user, $oldUser));
//
//        $message = ['success' => true];
//
//        return $request->has('redirect') ?
//            redirect()
//                ->away($request->get('redirect'))
//                ->with($message) :
//            redirect()
//                ->back()
//                ->with($message);
//    }
//
//    /**
//     * @param Request $request
//     * @param integer $id
//     * @return RedirectResponse
//     * @throws ORMException
//     */
//    public function delete(Request $request, $id)
//    {
//        if (!$this->permissionService->can(auth()->id(), 'delete-users')) {
//            throw new NotFoundHttpException();
//        }
//
//        $user = $this->userRepository->find($id);
//
//        if (!is_null($user)) {
//            $this->entityManager->remove($user);
//            $this->entityManager->flush();
//
//            event(new UserDeleted($user));
//        }
//
//        $message = ['success' => true];
//
//        return $request->has('redirect') ?
//            redirect()
//                ->away($request->get('redirect'))
//                ->with($message) :
//            redirect()
//                ->back()
//                ->with($message);
//    }
}
