<?php

namespace App\Modules\MusoraApi\Controllers\V2;

use App\Modules\Content\Services\LearningPathsService;
use App\Modules\FeatureFlagging\Facades\FeatureFlagging;
use Illuminate\Routing\Controller;

class LearningControllerV2 extends Controller
{
    public function __construct(private LearningPathsService $learningPathsService)
    {
    }

    public function getLearningPaths()
    {
        return $this->learningPathsService->getNewLearningPaths();
    }
}
