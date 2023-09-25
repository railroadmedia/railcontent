<?php

namespace App\Modules\Ecommerce\Services;

use Carbon\Carbon;
use Datetime;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Exception;
use Railroad\Ecommerce\Entities\AccessCode;
use Railroad\Ecommerce\Entities\Product;
use Railroad\Ecommerce\Entities\Subscription;
use Railroad\Ecommerce\Entities\SubscriptionAccessCode;
use Railroad\Ecommerce\Entities\User;
use Railroad\Ecommerce\Entities\UserProduct;
use Railroad\Ecommerce\Events\AccessCodeClaimed;
use Railroad\Ecommerce\Events\UserProducts\UserProductCreated;
use Railroad\Ecommerce\Exceptions\UnprocessableEntityException;
use Railroad\Ecommerce\Managers\EcommerceEntityManager;
use Railroad\Ecommerce\Repositories\AccessCodeRepository;
use Railroad\Ecommerce\Repositories\ProductRepository;
use Railroad\Ecommerce\Repositories\SubscriptionRepository;
use Railroad\Ecommerce\Services\UserProductService;
use Throwable;

/**
 * Class AccessCodeService
 *
 * @package Railroad\Ecommerce\Services
 */
class AccessCodeService
{
    /**
     * @var EcommerceEntityManager $entityManager
     */
    private EcommerceEntityManager $entityManager;

    /**
     * @var ProductRepository $productRepository
     */
    private ProductRepository $productRepository;

    /**
     * @var AccessCodeRepository $accessCodeRepository
     */
    private AccessCodeRepository $accessCodeRepository;

    /**
     * AccessCodeService constructor.
     *
     * @param EcommerceEntityManager $entityManager
     * @param ProductRepository $productRepository
     * @param SubscriptionRepository $subscriptionRepository
     * @param UserProductService $userProductService
     * @param AccessCodeRepository $accessCodeRepository
     */
    public function __construct(
        EcommerceEntityManager $entityManager,
        ProductRepository $productRepository,
        SubscriptionRepository $subscriptionRepository,
        UserProductService $userProductService,
        AccessCodeRepository $accessCodeRepository
    ) {
        $this->entityManager = $entityManager;
        $this->productRepository = $productRepository;
        $this->subscriptionRepository = $subscriptionRepository;
        $this->userProductService = $userProductService;
        $this->accessCodeRepository = $accessCodeRepository;
    }

    /**
     * Sets up the $accessCode as claimed by $user
     * extends $accessCode associated subscriptions
     * adds user products
     *
     * @param string $rawAccessCode
     * @param User $user
     *
     * @param null $context
     * @return AccessCode
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws Throwable
     * @throws \Doctrine\ORM\ORMException
     */
    public function claim(string $rawAccessCode, User $user, $context = null)
    : AccessCode {
        $accessCode = $this->accessCodeRepository->findOneBy(['code' => $rawAccessCode]);
        if (!$accessCode) {
            throw new Exception("Access code does not exist!");
        }

        $accessCode->setIsClaimed(true);
        $accessCode->setClaimer($user);
        $accessCode->setClaimedOn(Carbon::now());
        $accessCode->setUpdatedAt(Carbon::now());

        $this->entityManager->persist($accessCode);
        $this->entityManager->flush();

        event(new AccessCodeClaimed($accessCode, $user, $context));

        return $accessCode;
    }

    /**
     * @param array $productIds
     * @param string $brand
     * @param string|null $source
     * @return AccessCode
     * @throws ORMException
     * @throws \Doctrine\ORM\ORMException
     * @throws OptimisticLockException
     */
    public function generateAccessCode(array $productIds, string $brand, string $source = null)
    : AccessCode {
        $accessCode = new AccessCode();
        $accessCode->setProductIds($productIds);
        $accessCode->setBrand($brand);

        if ($source) {
            $accessCode->setSource($source);
        }

        $accessCode->generateCode();

        $this->entityManager->persist($accessCode);
        $this->entityManager->flush();

        return $accessCode;
    }

    /**
     * @param string $rawAccessCode
     * @return int[]
     * @throws \Doctrine\ORM\ORMException
     */
    public function getAccessCodeProducts(string $rawAccessCode)
    : array {
        $accessCode = $this->accessCodeRepository->findOneBy(['code' => $rawAccessCode]);
        if (!$accessCode) {
            throw new Exception("Access code $rawAccessCode not found.");
        }

        $accessCodeProducts = $this->productRepository->byAccessCode($accessCode);
        $productIds = [];

        collect($accessCodeProducts)->each(function (Product $product) use (&$productIds) {
            $codeRedeemProductHackMap = config('ecommerce.code_redeem_product_sku_swap', []);
            $accessCodeProductId = $product->getId();
            if (array_key_exists($product->getSku(), $codeRedeemProductHackMap)) {
                $replaceWithSku = $codeRedeemProductHackMap[$product->getSku()];
                $accessCodeProductId =
                    $this->productRepository->bySku($replaceWithSku)
                        ->getId();
            }
            $productIds[] = $accessCodeProductId;
        });

        return $productIds;
    }
}
