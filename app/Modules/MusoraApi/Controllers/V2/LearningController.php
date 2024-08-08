<?php

namespace App\Modules\MusoraApi\Controllers\V2;

use App\Modules\Content\Services\LearningPathsService;
use Illuminate\Routing\Controller;

class LearningController extends Controller
{
    public function __construct(private LearningPathsService $learningPathsService)
    {
    }

    public function getLearningPaths()
    {
        return $this->learningPathsService->getNewLearningPaths();
    }
}
