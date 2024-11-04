<?php

namespace App\Modules\RailTracker\tests;

use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Router;
use Modules\UserManagementSystem\Models\User;
use Tests\TestCase;
use PHPUnit\Framework\Assert;
use App\Modules\RailTracker\Console\Commands\ProcessTrackings;
use App\Modules\RailTracker\Middleware\RailtrackerMiddleware;
use App\Modules\RailTracker\Providers\RailtrackerServiceProvider;
use App\Modules\RailTracker\Services\BatchService;
use App\Modules\RailTracker\tests\Resources\Exceptions\Handler;

class RailtrackerTestCase extends TestCase
{

    /**
     * @var AuthManager
     */
    protected $authManager;

    /**
     * @var Router
     */
    protected $router;


    /** @var BatchService */
    protected $batchService;

    /** @var RailtrackerMiddleware $railtrackerMiddleware */
    protected $railtrackerMiddleware;

    const USER_AGENT_CHROME_WINDOWS_10 = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36';

    protected function setUp(): void
    {
        parent::setUp();

        $this->getEnvironmentSetUp($this->app);

        if (!defined('LARAVEL_START')) {
            define('LARAVEL_START', microtime(true));
        }

        $this->artisan('cache:clear', []);

        $this->databaseManager = $this->app->make(DatabaseManager::class);
        $this->authManager = $this->app->make(AuthManager::class);
        $this->router = $this->app->make(Router::class);
        $this->batchService = $this->app->make(BatchService::class);
        $this->railtrackerMiddleware = $this->app->make(RailtrackerMiddleware::class);

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        $this->databaseManager->table('railtracker4_requests')->truncate();
        $this->databaseManager->table('railtracker_content_last_engaged')->truncate();
        $this->databaseManager->table('railtracker_content_last_engaged_seconds')->truncate();
        $this->databaseManager->table('railtracker_media_playback_sessions')->truncate();
        $this->databaseManager->table('railtracker_media_playback_types')->truncate();
        $this->databaseManager->table('railtracker4_agent_strings')->truncate();
        $this->databaseManager->table('railtracker4_agent_browser_versions')->truncate();
        $this->databaseManager->table('railtracker4_agent_browsers')->truncate();
        $this->databaseManager->table('railtracker4_device_kinds')->truncate();
        $this->databaseManager->table('railtracker4_device_models')->truncate();
        $this->databaseManager->table('railtracker4_device_platforms')->truncate();
        $this->databaseManager->table('railtracker4_device_versions')->truncate();
        $this->databaseManager->table('railtracker4_exception_classes')->truncate();
        $this->databaseManager->table('railtracker4_exception_codes')->truncate();
        $this->databaseManager->table('railtracker4_exception_files')->truncate();
        $this->databaseManager->table('railtracker4_exception_lines')->truncate();
        $this->databaseManager->table('railtracker4_exception_messages')->truncate();
        $this->databaseManager->table('railtracker4_exception_traces')->truncate();
        $this->databaseManager->table('railtracker4_geo_ip_intermediary_lib')->truncate();
        $this->databaseManager->table('railtracker4_ip_addresses')->truncate();
        $this->databaseManager->table('railtracker4_ip_cities')->truncate();
        $this->databaseManager->table('railtracker4_ip_country_codes')->truncate();
        $this->databaseManager->table('railtracker4_ip_country_names')->truncate();
        $this->databaseManager->table('railtracker4_ip_currencies')->truncate();
        $this->databaseManager->table('railtracker4_ip_data')->truncate();
        $this->databaseManager->table('railtracker4_ip_latitudes')->truncate();
        $this->databaseManager->table('railtracker4_ip_longitudes')->truncate();
        $this->databaseManager->table('railtracker4_ip_postal_zip_codes')->truncate();
        $this->databaseManager->table('railtracker4_ip_regions')->truncate();
        $this->databaseManager->table('railtracker4_ip_timezones')->truncate();

        $this->databaseManager->table('railtracker4_language_preferences')->truncate();
        $this->databaseManager->table('railtracker4_language_ranges')->truncate();
        $this->databaseManager->table('railtracker4_methods')->truncate();
        $this->databaseManager->table('railtracker4_response_durations')->truncate();
        $this->databaseManager->table('railtracker4_response_status_codes')->truncate();
        $this->databaseManager->table('railtracker4_route_actions')->truncate();
        $this->databaseManager->table('railtracker4_route_names')->truncate();
        $this->databaseManager->table('railtracker4_url_domains')->truncate();
        $this->databaseManager->table('railtracker4_url_paths')->truncate();
        $this->databaseManager->table('railtracker4_url_protocols')->truncate();
        $this->databaseManager->table('railtracker4_url_queries')->truncate();
        $this->databaseManager->table('usora_users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        // clear everything *first*
        $toDelete =
            $this->batchService->connection()
                ->keys('*');
        if (!empty($toDelete)) {
            $this->batchService->connection()
                ->del($toDelete);
        }

        // test time
        Carbon::setTestNow(Carbon::parse('2020-03-26 17:50:38.84123'));
    }

    public function tearDown(): void
    {
        $toDelete =
            $this->batchService->connection()
                ->keys('*');

        if (!empty($toDelete)) {
            $this->batchService->connection()
                ->del($toDelete);
        }

        parent::tearDown();
    }

    /**
     * Define environment setup. (This runs *before* "setUp" method above)
     *
     * @param \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        config()->set('railtracker.global_is_active', true);
        config()->set('railtracker.cache_duration', 60);

        Carbon::setTestNow(Carbon::now());

        $time = Carbon::now()->timestamp . '_' . Carbon::now()->micro;

        $batchPrefix = 'railtracker_testing_' . $time . '_';

        $app['config']->set('railtracker.batch-prefix', $batchPrefix);

        $app->register(RailtrackerServiceProvider::class);
    }

    /**
     * We don't want to use mockery so this is a reimplementation of the event expectation.
     *
     * @param array|string $events
     * @return $this
     */
    public function expectsEvents($events)
    {
        $events = is_array($events) ? $events : func_get_args();

        $mock = $this->getMockBuilder(Dispatcher::class)
            ->onlyMethods(['dispatch'])
            ->getMockForAbstractClass();

        $mock->expects($this->any())
            ->method('dispatch')
            ->willReturnCallback(
                function ($called) {
                    $this->firedEvents[] = is_object($called) ? get_class($called) : $called;
                    return null;
                }
            );

        $this->app->instance('events', $mock);

        $this->beforeApplicationDestroyed(
            function () use ($events) {
                $fired = $this->getFiredEvents($events);
                $eventsNotFired = array_diff($events, $fired);

                Assert::assertEmpty(
                    $eventsNotFired,
                    'These expected events were not fired: [' . implode(', ', $eventsNotFired) . ']'
                );
            }
        );

        return $this;
    }

    /**
     * Get the list of fired events that we're interested in.
     *
     * @param array $events
     * @return array
     */
    protected function getFiredEvents(array $events)
    {
        return array_filter($this->firedEvents, function ($event) use ($events) {
            return in_array(is_object($event) ? get_class($event) : $event, $events);
        });
    }

    /**
     * @return int
     */
    public function createAndLogInNewUser()
    {
        $userId = User::factory()->create()->id;
        \Auth::loginUsingId($userId);
        return $userId;
    }

    /**
     * @param string $statusCode
     * @return \Illuminate\Http\Response
     */
    public function createResponse($statusCode)
    {
        return response()->json([true], $statusCode);
    }

    /**
     * @param string $userAgent
     * @param string $url
     * @param string $referer
     * @param string $clientIp
     * @param string $method
     * @param array $cookies
     * @return Request
     */
    public function createRequest(
        $userAgent = self::USER_AGENT_CHROME_WINDOWS_10,
        $url = 'https://www.testing.com/?test=1',
        $referer = 'http://www.referer-testing.com/?test=2',
        $clientIp = '183.22.98.51',
        $method = 'GET',
        $cookies = []
    ) {
        return Request::create(
            $url,
            $method,
            [],
            $cookies,
            [],
            [
                'SCRIPT_NAME' => parse_url($url)['path'] ?? '',
                'REQUEST_URI' => parse_url($url)['path'] ?? '',
                'QUERY_STRING' => parse_url($url)['query'] ?? '',
                'REQUEST_METHOD' => 'GET',
                'SERVER_PROTOCOL' => 'HTTP/1.1',
                'GATEWAY_INTERFACE' => 'CGI/1.1',
                'REMOTE_PORT' => '62517',
                'SCRIPT_FILENAME' => '/var/www/index.php',
                'SERVER_ADMIN' => '[no address given]',
                'CONTEXT_DOCUMENT_ROOT' => '/var/www/',
                'CONTEXT_PREFIX' => '',
                'REQUEST_SCHEME' => 'http',
                'DOCUMENT_ROOT' => '/var/www/',
                'REMOTE_ADDR' => $clientIp,
                'HTTP_X_FORWARDED_FOR' => $clientIp,
                'SERVER_PORT' => '80',
                'SERVER_ADDR' => '172.21.0.7',
                'SERVER_NAME' => parse_url($url)['host'],
                'SERVER_SOFTWARE' => 'Apache/2.4.18 (Ubuntu)',
                'HTTP_ACCEPT_LANGUAGE' => 'en-GB,en-US;q=0.8,en;q=0.6',
                'HTTP_ACCEPT_ENCODING' => 'gzip, deflate, sdch',
                'HTTP_ACCEPT' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                'HTTP_USER_AGENT' => $userAgent,
                'HTTP_REFERER' => $referer,
                'HTTP_UPGRADE_INSECURE_REQUESTS' => '1',
                'HTTP_CONNECTION' => 'keep-alive',
                'HTTP_HOST' => parse_url($url)['host'],
                'FCGI_ROLE' => 'RESPONDER',
                'PHP_SELF' => '/index.php',
                'REQUEST_TIME_FLOAT' => 1496790020.5194,
                'REQUEST_TIME' => 1496790020,
                'argv' => ['test=1'],
            ]
        );
    }

    /**
     * @param null $clientIp
     * @return Request
     */
    public function randomRequest($clientIp = null)
    {
        $method = $this->faker->randomElement(['GET', 'POST']);

        $protocol = $this->faker->randomElement(['HTTP', 'HTTPS']);

        $domain = $this->faker->randomElement(
            [$this->faker->domainName, $this->faker->domainWord . '.' . $this->faker->domainName]
        );

        $path = $this->faker->randomElement(
            [
                '',
                '/',
                '/' . $this->faker->word,
                '/' . $this->faker->word . '/',
                '/' . $this->faker->word . '/' . rand() . '/' . $this->faker->password,
                '/' . implode('/', range(1000000, 1000100)),
            ]
        );

        $queryString = $this->faker->randomElement(
            [
                '',
                '?',
                '?' . $this->faker->word . '=' . rand(),
                '?' . $this->faker->word . '=' . rand() . '&' . $this->faker->word . '=' . rand(),
                '?' . implode('&' . rand() . '=', range(2000000, 2000100)),
            ]
        );

        if (!$clientIp) {
            $clientIp = $this->faker->ipv4;
        }

        if ($this->faker->boolean()) {
            $routeName = $this->faker->word . '.' . $this->faker->word . '.' . $this->faker->word;
            $routeAction = ucwords($this->faker->word) . ucwords($this->faker->word) . '@' . $this->faker->word;

            $route = $this->router->get(
                $path,
                [
                    'as' => $routeName,
                    'uses' => $routeAction,
                ]
            );
        }

        if ($this->faker->boolean()) {
            $userId = $this->createAndLogInNewUser();
        }

        $request = Request::create(
            $this->faker->url,
            $method,
            [],
            [],
            [],
            [
                'SCRIPT_NAME' => '/index.php',
                'REQUEST_URI' => $path . $queryString,
                'QUERY_STRING' => $queryString,
                'REQUEST_METHOD' => $method,
                'SERVER_PROTOCOL' => 'HTTP/1.1',
                'GATEWAY_INTERFACE' => 'CGI/1.1',
                'REMOTE_PORT' => '62517',
                'SCRIPT_FILENAME' => '/var/www/index.php',
                'SERVER_ADMIN' => '[no address given]',
                'CONTEXT_DOCUMENT_ROOT' => '/var/www/',
                'CONTEXT_PREFIX' => '',
                'REQUEST_SCHEME' => 'http',
                'DOCUMENT_ROOT' => '/var/www/',
                'REMOTE_ADDR' => $clientIp,
                'HTTP_X_FORWARDED_FOR' => $clientIp,
                'SERVER_PORT' => '80',
                'SERVER_ADDR' => '172.21.0.7',
                'SERVER_NAME' => $protocol,
                'SERVER_SOFTWARE' => 'Apache/2.4.18 (Ubuntu)',
                'HTTP_ACCEPT_LANGUAGE' => 'en-GB,en-US;q=0.8,en;q=0.6',
                'HTTP_ACCEPT_ENCODING' => 'gzip, deflate, sdch',
                'HTTP_ACCEPT' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                'HTTP_USER_AGENT' => $this->faker->userAgent,
                'HTTP_REFERER' => $this->faker->url,
                'HTTP_UPGRADE_INSECURE_REQUESTS' => '1',
                'HTTP_CONNECTION' => 'keep-alive',
                'HTTP_HOST' => $domain,
                'FCGI_ROLE' => 'RESPONDER',
                'PHP_SELF' => '/index.php',
                'REQUEST_TIME_FLOAT' => 1496790020.5194,
                'REQUEST_TIME' => 1496790020,
                'argv' => ['test=1'],
            ]
        );

        if (isset($route)) {
            $request->setRouteResolver(
                function () use ($route) {
                    return $route;
                }
            );
        }

        if (isset($userId)) {
            $request->setUserResolver(
                function () use ($userId) {
                    return User::query()
                        ->find($userId);
                }
            );
        }

        return $request;
    }

    /**
     *
     */
    public function processTrackings()
    {
        try {
            $processTrackings = app()->make(ProcessTrackings::class);
            $processTrackings->handle();
        } catch (\Exception $exception) {
            error_log($exception);

            $this->fail(
                'RailtrackerTestCase::processTrackings threw exception with message: "' . $exception->getMessage() . '"'
            );
        }
    }

    /**
     * @param Request $request
     * @param null|Response|int|string $response
     */
    protected function sendRequest(Request $request, $response = 200)
    {
        if (gettype($response) === 'integer' || gettype($response) === 'string') {
            $response = $this->createResponse((integer)$response);
        }
        $middleWare = resolve(RailtrackerMiddleware::class);
        $middleWare->handle(
            $request,
            function () use ($response) {
                return $response;
            }
        );
        $middleWare->terminate(
            $request,
            $response
        );
    }

    /**
     * @param $userId
     * @param int $limit
     * @param int $skip
     * @param string $orderByProperty
     * @param string $orderByDirection
     * @return mixed
     */
    protected function getRequestsForUser(
        $userId,
        $limit = 25,
        $skip = 0
    ) {
        $results = $this->databaseManager
            ->table(config('railtracker.table_prefix') . 'requests')
            ->where('user_id', $userId)
            ->limit($limit)
            ->skip($skip)
            ->get();

        return $results;
    }

    protected function seeDbWhileDebugging()
    {
        $tables =
            \Illuminate\Support\Facades\DB::connection()
                ->getDoctrineSchemaManager()
                ->listTableNames(); // stackoverflow.com/a/40632654

        foreach ($tables as $table) {
            $result =
                \Illuminate\Support\Facades\DB::connection()
                    ->table($table)
                    ->select('*')
                    ->get()
                    ->all();
            foreach ($result as &$r) { // this changes contents from "stdClass::__set_state(array(...))" to "array (...)"
                $r = json_decode(json_encode($r), true);
            }
            $results[$table] = $result;
        }

        return $results ?? [];
    }

    protected function handleRequest(Request $request)
    {
        $response = $this->createResponse(200);
        $next = function () use ($response) {
            return $response;
        };
        $this->railtrackerMiddleware->handle($request, $next);
    }

    protected function throwExceptionDuringRequest(
        Request $request,
        $responseStatus = 500,
        Exception $exception = null,
        $exceptionMessage = 'Exception from throwExceptionDuringRequest method of RailtrackerTestCase'
    ) {
        $response = $this->createResponse($responseStatus);

        if (!$exception) {
            //            $exception = new \Exception($exceptionMessage);
            $exception = new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException($exceptionMessage);
        }

        $next = function ($request) use ($response, $exception) {
            app(Handler::class)->render($request, $exception);

            return $response;
        };

        $this->railtrackerMiddleware->handle($request, $next);
    }
}
