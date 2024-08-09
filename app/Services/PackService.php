<?php

namespace App\Services;

use App\Collections\PackCollection;
use App\Decorators\Content\AddedToPrimaryPlaylistDecorator;
use App\Decorators\Content\ContentExperienceDecorator;
use App\Decorators\Content\ContentLikesDecorator;
use App\Decorators\Content\LessonAssignmentDecorator;
use App\Decorators\Playlist\PlaylistDecorator;
use App\Modules\Content\Services\CohortService;
use Modules\UserManagementSystem\Models\User;
use Railroad\Railcontent\Decorators\Decorator;
use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Decorators\ModeDecoratorBase;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Helpers\FiltersHelper;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;

class PackService
{
    private ContentService $contentService;
    private CohortService $cohortService;

    public function __construct(ContentService $contentService, CohortService $cohortService)
    {
        $this->contentService = $contentService;
        $this->cohortService =  $cohortService;
    }

    /**
     * @param User $user
     *
     * @param bool $getAll
     *
     * @return PackCollection
     * @throws \Doctrine\ORM\ORMException
     */
    public function getPacksForHome(User $user): PackCollection
    {
        Decorator::$typeDecoratorsEnabled = true;
        ContentRepository::$pullFilterResultsOptionsAndCount = false;
        ModeDecoratorBase::$decorationMode = ModeDecoratorBase::DECORATION_MODE_MAXIMUM;
        ContentLikesDecorator::$decorationMode = DecoratorInterface::DECORATION_MODE_MAXIMUM;
        ContentRepository::$getEnrollmentContent = false;

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

        return $packs->slice(0, 3);
        // disable broken code, just return top 3.
        //        if ($user->isPackOnlyOwner()) {
        //            return $packs->slice(0, 3);
        //        } else {
        //            $userProducts = $this->userProductService->getAllUsersProducts($user->id);
        //            $productSkuToPackSlugArray = config('event-data-synchronizer.pack_ecommerce_product_sku_to_content_slug');
        //            $packsToShow = [];
        //
        //            foreach ($packs as $packIndex => $pack) {
        //                foreach ($userProducts as $userProduct) {
        //                    if (($productSkuToPackSlugArray[$userProduct->getProduct()
        //                            ->getSku()] ?? null) == $pack['slug']
        //                        && $userProduct->getCreatedAt() > Carbon::now()
        //                            ->subDays(3)
        //                    ) {
        //                        $packsToShow[] = $pack;
        //
        //                        break;
        //                    }
        //                }
        //            }
        //
        //            return new PackCollection(array_slice($packsToShow, 0, 3));
        //        }
    }


    public function getPacks($requiredFields = [], $sort = '-progress')
    {
        // Set up decorators and content retrieval options
        $this->setUpDecoratorsAndContentOptions();

        // Retrieve active cohort content ID
        $activeContentId = $this->cohortService->getActiveCohort()['content_id'] ?? 0;

        // Set default sort if undefined
        $sort = ($sort == 'undefined') ? '-progress' : $sort;

        // Retrieve packs
        $packs = $this->retrievePacks($sort);

        // Exclude active cohort content if exists
        $packs = $this->excludeActiveCohortContent($packs, $activeContentId);

        // Insert active cohort content at the beginning if exists
        $packs = $this->insertActiveCohortContent($packs, $activeContentId);

        return new ContentFilterResultsEntity([
            'results' => !is_array($packs) ? $packs->values()->toArray() : $packs,
            'total_results' => count($packs),
            'filter_options' => [],
        ]);
    }

    protected function setUpDecoratorsAndContentOptions()
    {
        ContentRepository::$pullFutureContent = true;
        AddedToPrimaryPlaylistDecorator::$skip = true;
        LessonAssignmentDecorator::$skip = true;
        ContentExperienceDecorator::$skip = true;
        ContentLikesDecorator::$skip = true;
        PlaylistDecorator::$decorationMode = DecoratorInterface::DECORATION_MODE_MINIMUM;
    }

    protected function retrievePacks($sort)
    {
        return $this->contentService->getFiltered(
            1,
            -1,
            $sort,
            ['pack', 'semester-pack'],
            [],
            [],
            FiltersHelper::$requiredFields,
            FiltersHelper::$includedFields,
            [],
            [],
            [],
            false,
            false,
            false
        )['results'];
    }

    protected function excludeActiveCohortContent($packs, $activeContentId)
    {
        if ($activeContentId && in_array($activeContentId, $packs->pluck('id')->toArray())) {
            $packs = $packs->filter(function ($pack) use ($activeContentId) {
                return $pack['id'] != $activeContentId;
            });
        }
        return $packs;
    }

    protected function insertActiveCohortContent($packs, $activeContentId)
    {
        if ($activeContentId) {
            $activeCohort = $this->contentService->getById($activeContentId);
            $packs =  $packs->values()->toArray();
            if ($activeCohort) {
                $activeCohort['status_text'] = "In Progress";
                array_unshift($packs, $activeCohort);
            }
        }
        return $packs;
    }
}
