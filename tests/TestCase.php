<?php

namespace Tests;

use App\Modules\EventDataSynchronizer\Middleware\UserActivitySyncMiddleware;
use Carbon\Carbon;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as FoundationBaseTestCase;
use Illuminate\Support\Facades\URL;
use PDO;
use PDOException;
use PHPUnit\Framework\ExpectationFailedException;
use SebastianBergmann\Comparator\ComparisonFailure;

abstract class TestCase extends FoundationBaseTestCase
{
    use RefreshDatabase;

    protected string $testRouteName = 'test-route';
    protected string $testRoutePath = 'https://test.musora.com';

    protected array $firedEvents = [];

    /**
     * @var Generator|Factory
     */
    protected Generator|Factory $faker;

    /**
     * Creates the application.
     *
     * @return Application
     */
    public function createApplication(): Application
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();
        return $app;
    }

    protected function setUp(): void
    {
        putenv('RAILFORUMS_DATA_MODE="client"'); //hack to skip rail forums migrations

        $this->faker = Factory::create();

        Carbon::setTestNow(Carbon::now());

        // Set up testing database and config values
        $host = env('DB_MUSORA_LARAVEL_MYSQL_WRITE_HOST', 'mysql8');
        $port = env('DB_MUSORA_LARAVEL_MYSQL_PORT', '3306');
        $username = env('DB_MUSORA_LARAVEL_MYSQL_USER_NAME', 'root');
        $password = env('DB_MUSORA_LARAVEL_MYSQL_PASSWORD', 'root');
        $database = env('DB_MUSORA_LARAVEL_MYSQL_DATABASE_NAME', 'musora_web_platform_automated_tests');

        try {
            $pdo = new PDO("mysql:host=$host;port=$port", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Create the database if it doesn't exist
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `$database`");
        } catch (PDOException $e) {
            die("DB ERROR: " . $e->getMessage());
        }

        parent::setUp();

        URL::forceRootUrl('https://testing.musora.com');

        // DEV NOTE our web_or_api_public middleware uses UserActivitySyncMiddleware and causes issues with the test
        // environment, due to calls to Redis and CustomerIO.
        // Disable the UserActivitySyncMiddleware middleware by default, since it can't be tested and causes errors.
        $this->withoutMiddleware(UserActivitySyncMiddleware::class);
    }

    protected function getRandomName($prefix = null)
    {
        $prefix ??= debug_backtrace(!DEBUG_BACKTRACE_PROVIDE_OBJECT | DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1]['function'];
        $end = $this->faker->regexify('\d{4}-\d{4}-\d{4}-\d{4}');
        return $prefix . $end;
    }

    public function assertArraySubsetMatch(array $subset, array $array, bool $strict = false, string $message = ''): void
    {
        $differences = [];

        $findDifferences = function ($subset, $array, $path = '') use (&$findDifferences, $strict, &$differences) {
            foreach ($subset as $key => $value) {
                $currentPath = $path ? "{$path}.{$key}" : $key;

                if (!array_key_exists($key, $array)) {
                    $differences[] = ["path" => $currentPath, "expected" => $value, "actual" => "<<missing>>"];
                    continue;
                }

                if (is_array($value)) {
                    if (!is_array($array[$key])) {
                        $differences[] = ["path" => $currentPath, "expected" => "array", "actual" => gettype($array[$key])];
                    } else {
                        $findDifferences($value, $array[$key], $currentPath);
                    }
                } else {
                    $match = $strict ? $array[$key] === $value : $array[$key] == $value;
                    if (!$match) {
                        $differences[] = [
                            "path" => $currentPath,
                            "expected" => $value,
                            "actual" => $array[$key]
                        ];
                    }
                }
            }
        };

        $findDifferences($subset, $array);

        $formatValue = function ($value) {
            if (is_bool($value)) {
                return $value ? 'true' : 'false';
            }
            if (is_null($value)) {
                return 'null';
            }
            if (is_string($value)) {
                return "'{$value}'";
            }
            if (is_array($value)) {
                return 'array(' . count($value) . ')';
            }
            return var_export($value, true);
        };

        if (!empty($differences)) {
            $context = $strict ? 'strict' : 'non-strict';
            $failureDescription = sprintf(
                "Failed asserting that an array has the subset.\nDifferences found (%s mode):\n%s",
                $context,
                implode("\n", array_map(function ($diff) use ($formatValue) {
                    return sprintf(
                        "  At path '%s':\n    Expected: %s\n    Actual: %s",
                        $diff['path'],
                        $formatValue($diff['expected']),
                        $formatValue($diff['actual'])
                    );
                }, $differences))
            );

            throw new ExpectationFailedException(
                $message . "\n" . $failureDescription,
                new ComparisonFailure($subset, $array, var_export($subset, true), var_export($array, true))
            );
        }

        $this->assertEmpty($differences);
    }
}
