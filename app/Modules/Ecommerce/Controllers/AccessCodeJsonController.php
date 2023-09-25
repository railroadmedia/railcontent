<?php

namespace App\Modules\Ecommerce\Controllers;

use App\Modules\Ecommerce\Enums\UserAccessPermissionsSourceEnum;
use App\Modules\Ecommerce\Services\AccessCodeService;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use Carbon\Carbon;
use Google\Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Ecommerce\Contracts\UserProviderInterface;
use Railroad\Ecommerce\Exceptions\NotFoundException;
use Railroad\Ecommerce\Managers\EcommerceEntityManager;
use Railroad\Ecommerce\Repositories\AccessCodeRepository;
use Railroad\Ecommerce\Repositories\ProductRepository;
use Railroad\Ecommerce\Requests\AccessCodeJsonClaimRequest;
use Railroad\Ecommerce\Requests\AccessCodeReleaseRequest;
use Railroad\Ecommerce\Services\ResponseService;
use Railroad\Permissions\Services\PermissionService;
use Throwable;

use function key_array_of_entities_by;

class AccessCodeJsonController extends Controller
{
    /**
     * @var AccessCodeRepository $accessCodeRepository
     */
    private AccessCodeRepository $accessCodeRepository;

    /**
     * @var AccessCodeService $accessCodeService
     */
    private AccessCodeService $accessCodeService;

    /**
     * @var EcommerceEntityManager $entityManager
     */
    private EcommerceEntityManager $entityManager;

    /**
     * @var PermissionService $permissionService
     */
    private PermissionService $permissionService;

    /**
     * @var ProductRepository $productRepository
     */
    private ProductRepository $productRepository;

    /**
     * @var UserProviderInterface $userProvider
     */
    private UserProviderInterface $userProvider;

    private UserAccessPermissionsService $userAccessPermissionsService;

    /**
     * AccessCodeJsonController constructor.
     *
     * @param AccessCodeRepository $accessCodeRepository
     * @param AccessCodeService $accessCodeService
     * @param EcommerceEntityManager $entityManager
     * @param PermissionService $permissionService
     * @param ProductRepository $productRepository
     * @param UserProviderInterface $userProvider
     * @param UserAccessPermissionsService $userAccessPermissionsService
     */
    public function __construct(
        AccessCodeRepository $accessCodeRepository,
        AccessCodeService $accessCodeService,
        EcommerceEntityManager $entityManager,
        PermissionService $permissionService,
        ProductRepository $productRepository,
        UserProviderInterface $userProvider,
        UserAccessPermissionsService $userAccessPermissionsService
    ) {
        $this->accessCodeRepository = $accessCodeRepository;
        $this->accessCodeService = $accessCodeService;
        $this->entityManager = $entityManager;
        $this->permissionService = $permissionService;
        $this->productRepository = $productRepository;
        $this->userProvider = $userProvider;
        $this->userAccessPermissionsService = $userAccessPermissionsService;
    }

    /**
     * Paginated list of access codes, for admins only
     *
     * @param Request $request
     *
     * @return JsonResponse
     *
     * @throws Throwable
     */
    public function index(Request $request)
    {
        $this->permissionService->canOrThrow(auth()->id(), 'pull.access_codes');

        $accessCodesAndBuilder = $this->accessCodeRepository->indexByRequest($request);

        $products = $this->productRepository->byAccessCodes($accessCodesAndBuilder->getResults());

        return ResponseService::decoratedAccessCode(
            $accessCodesAndBuilder->getResults(),
            key_array_of_entities_by($products),
            $accessCodesAndBuilder->getQueryBuilder()
        )
            ->respond();
    }

    /**
     * Search for access codes, for admins only
     *
     * @param Request $request
     *
     * @return JsonResponse
     *
     * @throws Throwable
     */
    public function search(Request $request)
    {
        $this->permissionService->canOrThrow(auth()->id(), 'pull.access_codes');

        $accessCodesAndBuilder = $this->accessCodeRepository->searchByRequest($request);

        $products = $this->productRepository->byAccessCodes($accessCodesAndBuilder->getResults());

        return ResponseService::decoratedAccessCode(
            $accessCodesAndBuilder->getResults(),
            key_array_of_entities_by($products),
            $accessCodesAndBuilder->getQueryBuilder()
        )
            ->respond();
    }

    /**
     * Claim an access code
     *
     * @param AccessCodeJsonClaimRequest $request
     *
     * @return JsonResponse
     *
     * @throws Throwable
     */
    public function claim(AccessCodeJsonClaimRequest $request)
    {
        $this->permissionService->canOrThrow(auth()->id(), 'claim.access_codes');

        $user = $this->userProvider->getUserById($request->get('claim_for_user_id'));

        throw_if(
            is_null($user),
            new NotFoundException(
                'Claim failed, user not found with id: ' . $request->get('claim_for_user_id')
            )
        );

        $rawAccessCode = $request->get('access_code');

        /*
         * SRR-37: Push new order into Shopify
         * Executing this before claiming access code as it's simpler to cancel the order afterwards
         *  in case there's an error when claiming
         */
        $productIds = $this->accessCodeService->getAccessCodeProducts($rawAccessCode);

        /*
         * SRR-37: Update user permissions
         */
        $this->userAccessPermissionsService->addUserAccessPermissionsForProducts(
            $user->getId(),
            $productIds,
            Carbon::now(),
            UserAccessPermissionsSourceEnum::AccessCode,
        );

        $accessCode = $this->accessCodeService->claim($rawAccessCode, $user, $request->get('context'));

        return ResponseService::accessCode($accessCode)
            ->respond();
    }

    /**
     * Release an access code
     *
     * @param AccessCodeReleaseRequest $request
     *
     * @return JsonResponse
     *
     * @throws Throwable
     */
    public function release(AccessCodeReleaseRequest $request)
    {
        $this->permissionService->canOrThrow(auth()->id(), 'release.access_codes');
        $accessCodeId = $request->get('access_code_id');

        $accessCode = $this->accessCodeRepository->find($accessCodeId);
        if (!$accessCode) {
            throw new Exception("Access code for ID $accessCodeId not found.");
        }

        $accessCode->setIsClaimed(false);
        $accessCode->setClaimer(null);
        $accessCode->setClaimedOn(null);
        $accessCode->setUpdatedAt(Carbon::now());

        $this->entityManager->flush();

        return ResponseService::accessCode($accessCode)
            ->respond();
    }
}
