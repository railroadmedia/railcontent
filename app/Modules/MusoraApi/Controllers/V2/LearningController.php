<?php

namespace App\Modules\MusoraApi\Controllers\V2;

use App\Modules\Content\Services\LearningPathsService;
use App\Modules\FeatureFlagging\Facades\FeatureFlagging;
use Illuminate\Routing\Controller;

class LearningController extends Controller
{
    public function __construct(private LearningPathsService $learningPathsService)
    {
    }

    public function getLearningPaths()
    {
        $homepageV2 = boolval(FeatureFlagging::branch('homepage-v2', user()));
        return $this->learningPathsService->getNewLearningPaths($homepageV2);
    }
}
