<?php
namespace App\Modules\RailTracker\tests\Functional;

use App\Modules\RailTracker\Models\Requests;
use App\Modules\RailTracker\tests\RailtrackerTestCase;
use Carbon\Carbon;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Contracts\Http\Kernel as HttpKernel;
use App\Modules\RailTracker\Middleware\RailtrackerMiddleware;
use App\Modules\RailTracker\tests\Resources\Exceptions\Handler;
use App\Modules\RailTracker\ValueObjects\RequestVO;

class ProcessTrackingsTest extends RailtrackerTestCase
{
    public function test_track_response_status_code()
    {
        $request = $this->randomRequest();

        $this->sendRequest($request);
        $this->processTrackings();

        $this->assertDatabaseHas(
            Requests::class,
            [
                'response_status_code' => 200,
            ]
        );
    }

    public function test_track_response_status_code_404()
    {
        $request = $this->randomRequest();
        $response = $this->createResponse(404);

        $this->sendRequest($request, $response);
        $this->processTrackings();

        $this->assertDatabaseHas(
            Requests::class,
            [
                'response_status_code' => 404
            ]
        );
    }

    public function test_track_response()
    {
        $request = $this->randomRequest();
        $response = $this->createResponse(200);

        $this->sendRequest($request, $response);
        $this->processTrackings();

        $this->assertDatabaseHas(
            Requests::class,
            [
                'id' => 1,
                'response_status_code' => 200,
                'responded_on' => rtrim(Carbon::now()->format(RequestVO::$TIME_FORMAT), '0'),
            ]
        );
    }

    public function test_track_404_exception()
    {
        $this->markTestSkipped('Not working after update and migration to MWP.');
        app()->singleton(
            ExceptionHandler::class,
            Handler::class
        );

        $kernel = app()->make(HttpKernel::class);
        $kernel->pushMiddleware(RailtrackerMiddleware::class);

        $request = $this->randomRequest();
        $kernel->handle($request);

        try {
            $this->processTrackings();
        } catch (\Exception $exception) {
            $this->fail(
                'RailtrackerTestCase::processTrackings threw exception with message: "' . $exception->getMessage() . '"'
            );
        }

        $this->assertDatabaseHas(
            Requests::class,
            [
                'id' => 1,
                'exception_class_hash' => md5('Symfony\\Component\\HttpKernel\\Exception\\NotFoundHttpException'),
                'response_status_code' => '404',
            ]
        );
    }


}
