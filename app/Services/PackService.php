<?php

namespace App\Services;

use App\Collections\PackCollection;
use App\Decorators\Content\AddedToPrimaryPlaylistDecorator;
use App\Decorators\Content\ContentExperienceDecorator;
use App\Decorators\Content\ContentLikesDecorator;
use App\Decorators\Content\LessonAssignmentDecorator;
use App\Decorators\Content\PackDecorator;
use App\Decorators\Playlist\PlaylistDecorator;
use Carbon\Carbon;
use Modules\UserManagementSystem\Models\User;
use Railroad\Railcontent\Decorators\Decorator;
use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Decorators\ModeDecoratorBase;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;

class PackService
{
    private ContentService $contentService;
    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    /**
     * @param User $user
     *
     * @param bool $getAll
     *
     * @return PackCollection
     * @throws \Doctrine\ORM\ORMException
     */
    public function getPacksForHome(User $user, $getAll = false)
    {
        Decorator::$typeDecoratorsEnabled = true;
        ContentRepository::$pullFilterResultsOptionsAndCount = false;
        ModeDecoratorBase::$decorationMode = ModeDecoratorBase::DECORATION_MODE_MAXIMUM;
        ContentLikesDecorator::$decorationMode = DecoratorInterface::DECORATION_MODE_MAXIMUM;

        $oldPullFutureContent = ContentRepository::$pullFutureContent;
        $oldAvailableContentStatues = ContentRepository::$availableContentStatues;

        ContentRepository::$pullFutureContent = true;
        ContentRepository::$availableContentStatues = [
            ContentService::STATUS_PUBLISHED,
            ContentService::STATUS_SCHEDULED
        ];

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


    public function getPacks($requiredFields = [])
    {
        ContentRepository::$pullFutureContent = true;
        AddedToPrimaryPlaylistDecorator::$skip = true;
        LessonAssignmentDecorator::$skip = true;
        ContentExperienceDecorator::$skip = true;
        ContentLikesDecorator::$skip = true;
        PlaylistDecorator::$decorationMode = DecoratorInterface::DECORATION_MODE_MINIMUM;

        $packs = (new PackCollection(
            $this->contentService->getFiltered(
                1,
                -1,
                '-published_on',
                ['pack', 'semester-pack'],
                [],
                [],
                $requiredFields,
                [],
                [],
                [],
                false,
                false,
                false
            )['results']
        ))->sortPacks(user()?->id);

        return new ContentFilterResultsEntity([
            'results' => $packs->values()->toArray(),
            'total_results' => count($packs),
            'filter_options' => [],
        ]);
    }
}
