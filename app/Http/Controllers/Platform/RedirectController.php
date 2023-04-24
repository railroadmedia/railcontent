<?php

namespace App\Http\Controllers\Platform;

use App\Collections\PackCollection;
use App\Decorators\Content\ContentLikesDecorator;
use App\Decorators\Content\LessonAssignmentDecorator;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Content\CoachesController;
use App\Maps\ContentTypes;
use App\Services\LiveStreamEventService;
use App\Services\PackService;
use App\Services\UserMetricsService;
use Illuminate\Support\Facades\Mail;
use Modules\UserManagementSystem\Models\BlockedUser;
use Railroad\Railcontent\Services\UserContentProgressService;
use Carbon\Carbon;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Modules\UserManagementSystem\Models\User;
use Railroad\Points\Services\UserPointsService;
use Railroad\Railcontent\Decorators\Decorator;
use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Decorators\ModeDecoratorBase;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentFollowsService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserPlaylistsService;
use Railroad\Railcontent\Support\Collection as RailcontentCollection;
use Railroad\Railforums\Repositories\PostRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Modules\Content\Services\CarouselService;

class RedirectController extends BaseController
{

    public function __construct()
    {
    }

    public function homeRedirect()
    {
        return redirect()->route('platform.home', ['brand' => brand()]);
    }

    public function profileRedirect()
    {
        return redirect("/" . brand() . "/profile/" . user()->id . "/dashboard");
    }

    public function paymentSettingsRedirect()
    {
        return redirect("/" . brand() . "/profile/" . user()->id . "/settings/payments");
    }

    public function notificationsRedirect()
    {
        return redirect("/" . brand() . "/notifications");
    }

    public function notificationSettingsRedirect()
    {
        return redirect("/" . brand() . "/profile/" . user()->id . "/settings/notifications");
    }

    public function redirect30day()
    {
        return view('pages.redirect30day');
    }

    public function redirectPurchase(Request $request, $domain, $brand)
    {
        $products = explode(',', $request->get('products'));
        return redirect()->route('platform.home', ['brand' => $brand]);
    }
}
