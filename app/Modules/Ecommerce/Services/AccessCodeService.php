<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\Enums\UserAccessPermissionsSourceEnum;
use App\Modules\Ecommerce\Events\AccessCodeClaimed;
use App\Modules\Ecommerce\Models\AccessCode;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\UserManagementSystem\Services\UserService;
use Carbon\Carbon;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Exception;
use Log;
use Modules\UserManagementSystem\Models\User;
use Throwable;

class AccessCodeService
{
    private UserAccessPermissionsService $userAccessPermissionsService;
    private ProductService $productService;
    private UserService $userService;

    public function __construct(
        UserAccessPermissionsService $userAccessPermissionsService,
        ProductService $productService,
        UserService $userService
    ) {
        $this->userAccessPermissionsService = $userAccessPermissionsService;
        $this->productService = $productService;
        $this->userService = $userService;
    }


    public function claimByUserId(string $code, ?int $userId, $context = null): AccessCode
    {
        $user = $this->userService->getByIdOrNull($userId);
        if (!$user) {
            throw new Exception('Claim failed, user not found with id: ' . $userId);
        }
        return $this->claim($code, $user, $context);
    }

    /**
     * Sets up the $accessCode as claimed by $user
     * extends $accessCode associated subscriptions
     * adds user products
     *
     * @throws Throwable
     */
    public function claim(string $code, User $user, ?string $context = null): AccessCode
    {
        /** @var AccessCode $accessCode */
        $accessCode = $this->getAccessCode($code);
        if (!$accessCode) {
            throw new Exception("Access code does not exist!");
        }

        if ($accessCode->is_claimed) {
            throw new Exception("Access code has already been redeemed!");
        }

        $productIds = $this->getAccessCodeProducts($accessCode);

        $this->userAccessPermissionsService->addUserAccessPermissionsForProducts(
            $user->id,
            $productIds,
            Carbon::now(),
            $accessCode->id,
            UserAccessPermissionsSourceEnum::AccessCode,
        );

        $accessCode->is_claimed = true;
        $accessCode->claimer_id = $user->id;
        $accessCode->claimed_on = Carbon::now();
        $accessCode->updated_at = Carbon::now();
        $accessCode->save();

        event(new AccessCodeClaimed($accessCode, $user, $context));

        Log::info('Access code claimed', [
            'access_code' => $accessCode->code,
            'user_id' => $user->id,
        ]);

        return $accessCode;
    }

    public function release(?string $id): void
    {
        /** @var AccessCode $accessCode */
        $accessCode = AccessCode::query()->find($id);
        if (!$accessCode) {
            throw new Exception("Access code for ID $id not found.");
        }
        $accessCode->is_claimed = false;
        $accessCode->claimer_id = null;
        $accessCode->claimed_on = null;
        $accessCode->updated_at = Carbon::now();
        $accessCode->save();
    }

    public function generateAccessCode(array $productIds, string $brand, string $source = null): AccessCode
    {
        $accessCode = new AccessCode();
        $accessCode->product_ids = serialize($productIds);
        $accessCode->brand = $brand;
        $accessCode->is_claimed = false;

        if ($source) {
            $accessCode->source = $source;
        }

        $accessCode->generateCode();
        $accessCode->save();
        return $accessCode;
    }

    public function getAccessCodeProducts(AccessCode $accessCode): array
    {
        $accessCodeProducts = $this->productService->getByAccessCode($accessCode);
        $productIds = [];

        collect($accessCodeProducts)->each(function (Product $product) use (&$productIds) {
            $codeRedeemProductHackMap = config('ecommerce.code_redeem_product_sku_swap', []);
            $accessCodeProductId = $product->id;
            if (array_key_exists($product->sku, $codeRedeemProductHackMap)) {
                $replaceWithSku = $codeRedeemProductHackMap[$product->sku];
                $accessCodeProductId = $this->productService->getBySku($replaceWithSku)->id;
            }
            $productIds[] = $accessCodeProductId;
        });

        return $productIds;
    }

    /**
     * Turns: fcbd53d4b41b3264249a713e
     * Into: fcbd - 53d4 - b41b - 3264 - 249a - 713e
     *
     * @param $code
     * @return string
     */
    public function hyphenateCode($code): string
    {
        return implode(" - ", str_split($code, 4));
    }

    /**
     * @param string|null $code
     * Into: Check if access code exists; if it exists, split the access code into 6 parts and return it as an array;
     *     if not, return null
     * @return ?array
     */
    public function checkAndSplitAccessCode(?string $code): ?array
    {
        if (!$code) {
            return null;
        }
        $accessCode = $this->getAccessCode($code);
        return ($accessCode) ? str_split($code, 4) : null;
    }

    public function getAccessCode(?string $code): ?AccessCode
    {
        return AccessCode::query()->where('code', $code)->first() ?? null;
    }
}
