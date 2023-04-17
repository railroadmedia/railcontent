<?php

namespace App\Services;

use App\Collections\PackCollection;
use App\Decorators\Content\ContentLikesDecorator;
use Carbon\Carbon;
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Services\UserProductService;
use Railroad\Railcontent\Decorators\Decorator;
use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Decorators\ModeDecoratorBase;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;

class PackService
{
    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * @var UserProductService
     */
    private $userProductService;

    public function __construct(ContentService $contentService, UserProductService $userProductService)
    {
        $this->contentService = $contentService;
        $this->userProductService = $userProductService;
    }

    /**
     * @param User $user
     *
     * @param bool $getAll
     *
     * @return PackCollection
     * @throws \Doctrine\ORM\ORMException
     */
    public function getPacks(User $user, $getAll = false)
    {
        Decorator::$typeDecoratorsEnabled = true;
        ContentRepository::$pullFilterResultsOptionsAndCount = false;
        ModeDecoratorBase::$decorationMode = ModeDecoratorBase::DECORATION_MODE_MAXIMUM;
        ContentLikesDecorator::$decorationMode = DecoratorInterface::DECORATION_MODE_MAXIMUM;

        $oldPullFutureContent = ContentRepository::$pullFutureContent;
        $oldAvailableContentStatues = ContentRepository::$availableContentStatues;

        ContentRepository::$pullFutureContent = true;
        ContentRepository::$availableContentStatues = [ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED];

        $packs = (new PackCollection(
            $this->contentService->getFiltered(1, -1, '-published_on', ['pack', 'semester-pack'])['results']
        ))->sortPacks($user->id);

        ContentRepository::$pullFutureContent = $oldPullFutureContent;
        ContentRepository::$availableContentStatues = $oldAvailableContentStatues;

        if ($user->isPackOnlyOwner()) {
            if ($getAll) {
                return $packs;
            }

            return $packs->slice(0, 3);
        } else {
            if ($getAll) {
                return $packs;
            }

            $userProducts = $this->userProductService->getAllUsersProducts($user->id);
            $productSkuToPackSlugArray = config('event-data-synchronizer.pack_ecommerce_product_sku_to_content_slug');
            $packsToShow = [];

            foreach ($packs as $packIndex => $pack) {
                foreach ($userProducts as $userProduct) {
                    if (($productSkuToPackSlugArray[$userProduct->getProduct()
                                ->getSku()] ?? null) == $pack['slug']
                        && $userProduct->getCreatedAt() > Carbon::now()
                            ->subDays(3)
                    ) {
                        $packsToShow[] = $pack;

                        break;
                    }
                }
            }

            return new PackCollection(array_slice($packsToShow, 0, 3));
        }
    }
}
