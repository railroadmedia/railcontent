<?php

namespace App\Http\Controllers\Platform;

use Illuminate\Http\Request;
use Railroad\Railcontent\Decorators\ModeDecoratorBase;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Mailora\Services\MailService;
use Railroad\Ecommerce\Repositories\ProductRepository;
use Illuminate\Routing\Controller;

class CohortPackPageController extends Controller
{
    public function cohortPack()
    {
        return view('content.cohort-template');
    }
}
