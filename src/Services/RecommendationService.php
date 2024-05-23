<?php

namespace Railroad\Railcontent\Services;

use App\Modules\UserManagementSystem\Services\UserService;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Railroad\Railcontent\Enums\RecommenderSection;

enum AccessMethod {
    case PDO;
    case DB;
    case HUGGINGFACE;
}

class RecommendationService
{

    public AccessMethod $defaultAccessMethod;
    private array $RETRY_ERROR_CODES = [503];

    public function __construct(
        private UserPermissionsService $userPermissionsService,
        private UserService $userService,
    ) {
        $this->defaultAccessMethod = AccessMethod::DB;
        $this->invalidConfigurations = [
            'pianote' => [RecommenderSection::Course],
            'singeo' => [RecommenderSection::Course],
        ];
    }

    public function getFilteredRecommendations($userID, $brand, array $sections=[], bool $useFastImplementation=false): array
    {
        // Single section state where we call the faster implementation
        if ($useFastImplementation && count($sections) == 1) {
            $section = $sections[0];
            if ($this->hasNoResults($brand, $section)) {
                return [];
            }
            return [
                strtolower($section->value) => $this->getFilteredRecommendationsBySection($userID, $brand, $section)
            ];
        }
        return $this->getAllFilteredRecommendations($userID, $brand);
    }


    private function hasNoResults($brand, $section): bool
    {
        $brand = strtolower($brand);
        return isset($this->invalidConfigurations[$brand]) && in_array($section, $this->invalidConfigurations[$brand]);
    }

    private function getFilteredRecommendationsBySection($userID, $brand, RecommenderSection $section)
    {
        $data = [
            'user_ids' => [$userID],
            'brand' => $brand,
            'section' => $section->value
        ];
        $content = $this->requestData($data);
        if (!isset($content[$userID])) {
            $msg = print_r($content, true);
            Log::warning("Unexpected data from RecSys: $msg");
        }
        return $content[$userID] ?? [];
    }

    private function getAllFilteredRecommendations($userID, $brand)
    {
        $data = [
            'user_ids' => [$userID],
            'brand' => $brand,
        ];
        $content = $this->requestData($data);
        if (!isset($content[$userID])) {
            $msg = print_r($content, true);
            Log::warning("Unexpected data from RecSys $msg");
        }
        return $content[$userID] ?? [];
    }

    private function requestData($data, AccessMethod $accessMethod = null)
    {
        $accessMethod ??= $this->defaultAccessMethod;
        $returnData = match($accessMethod) {
            AccessMethod::HUGGINGFACE => $this->postToHuggingFaceWithRetry($data),
            AccessMethod::PDO => throw new InvalidArgumentException('RecSys PDB Connection  not supported'),
            AccessMethod::DB => $this->pullFromDataBase($data),
        };
        return $returnData;
    }

    private function pullFromDataBase($data)
    {
        if ($data['user_ids']->count() > 1) {
            throw new InvalidArgumentException('RecommendationService DB handler does not support multiple userIds');
        }
        if (!is_set($data['section'])) {
            $data['section'] = array_column(RecommenderSection::cases(), 'value');
        }
        $userID = $data['user_ids'][0];
        $recommendations = [$userID => []];
        foreach($data['section'] as $section) {
            $recommendations[$userID][$section] = $this->getUserRecommendationsOrColdStartFromDB($userID, $data['brand'], $section);
        }
        return $recommendations;
    }

    private function getUserRecommendationsOrColdStartFromDB(int $userID, string $brand, string $section, int $limit=20)
    {
        $tableName = $brand . $section . '_recommendations';
        $recommendations = DB::table($tableName)->where('user_id', $userID)->orderBy('recommendation_rank')->limit($limit);

        if (!$recommendations) {
            $user = $this->userService->getByIdOrNull($userID);
            $recommendations = [];
            if (!$user) {
                return $recommendations;
            }
            if ($user->isAPlusMember() || ($user->isABasicMember() || $section != RecommenderSection::Song->value)){
                $coldStartTableName = $brand . '_' . $section . '_BEGINNER_POPULAR_ITEMS_RECOMMENDATIONS';
                $recommendations = DB::table($coldStartTableName)->orderBy('popularity_rank')->limit(20);
            }
        }
        return $recommendations;
    }

    private function postToHuggingFaceWithRetry($data) {
        $url = config('railcontent.recsys.url');
        $authToken = config('railcontent.recsys.token');
        $timeout = 12;
        try {
            $response = Http::withToken($authToken)->timeout($timeout)->post($url, $data);
            $status = $response->status();
            if (in_array($status, $this->RETRY_ERROR_CODES)) {
                $response = Http::withToken($authToken)->timeout($timeout)->post($url, $data);
            } else {
                if ($status == 500) {
                    // attempt the backup URL
                    $backupURL = config('railcontent.recsys.backup_url');
                    $response = Http::withToken($authToken)->timeout($timeout)->post($backupURL, $data);
                    $status = $response->status();
                }
            }
        } catch (ConnectionException $ex) {
            Log::warning("HuggingFace connection timed out after $timeout s");
            return [];
        }

        $content = $response->json();
        if ($status != 200)
        {
            Log::warning("HuggingFace return an unexpected response with code: $status");
            $msg = print_r($content, true);
            Log::warning("HuggingFace: Content returned: $msg");
            return [];
        }
        return $content;
    }

// The following code includes functionality using a direct PDO connection to the snowflake db instead of through a web api.
// This was commented out to avoid importing unnecessary libraries, but may need to be ressurected for performance later.
// 1. Check the railenvironment branch: dev/amcneill20240102_MT-805_recommender_v2 for the updated docker file that will work on the local development environment
// 2. update config/app.php to include LaravelPdoOdbc\ODBCServiceProvider::class
// 3. Update this file with usings and uncommend below:
//    use Exception;
//    use Illuminate\Database\DatabaseManager;
//    use PDO;
// THe following instructions are for implementing this on the production and staging environments (ie: not rrr.sh local)
// 4. In order the pdo_snowflake.so file needs to be built for each environment (laravelphp/vapour:php81) Instructions here. https://github.com/snowflakedb/pdo_snowflake?tab=readme-ov-file#building-the-driver-on-linux-and-macos
// 4.1 Adrian: I will be honest, I'm not 100% sure how to do this through AWS Lambda. Instructions online indicated that you would install the equivalent docker locally, then ssh in, run the instructions and copy the .so file out.
// This is what I did for the local environments, but you can't ssh onto a lamba instance, soooo.
// 5. Update musora-web-platform/X.docker files to copy .so file and cacert.pem files to container
//#COPY ./pdo_snowflake.so /usr/local/lib/php/extensions/no-debug-non-zts-20210902/pdo_snowflake.so
//#COPY ./cacert.pem /opt/docker/etc/php/fpm/cacert.pem
// 6. Update the vapor-php.ini  files to include the extension and cacert reference:
//extension=pdo_snowflake
//pdo_snowflake.cacert=/opt/docker/etc/php/fpm/cacert.pem

//    private function getFilteredRecommendationsUsingPDO($userID, $brand, RecommenderSection $section) : array
//    {
//        $connection = $this->databaseManager->connection('snowflake_pdo');
//        $query = "CALL RECSYS.RECOMMENDATIONS.GET_FILTERED_RECOMMENDATIONS('$userID', '$brand', '$section->value')";
//        try {
//            $result = $connection->select($query);
//            $contentIDs = json_decode($result[0]->GET_FILTERED_RECOMMENDATIONS);
//        } catch (Exception $e) {
//            error_log($e);
//            $contentIDs = [];
//        }
//        return $contentIDs;
//    }
//
//    public function getBulkFilterRecommendations($userIDs, $brand, RecommenderSection $section) : array
//    {
//
//        $connection = $this->databaseManager->connection('snowflake_pdo');
//        $content = [];
//        $idString = implode(',', $userIDs);
//        $query = "CALL RECSYS.RECOMMENDATIONS.GET_BATCH_FILTERED_RECOMMENDATIONS([$idString], '$brand', '$section->value')";
//        try {
//            $result = $connection->select($query);
//            $content = json_decode($result[0]->GET_BATCH_FILTERED_RECOMMENDATIONS);
//        } catch (Exception $e) {
//            error_log($e);
//        }
//        return $content;
//    }
//
//    private function getFilteredRecommendationsUsingDBHandler($userID, $brand, RecommenderSection $section) : array
//    {
//        $databaseHandler = $this->createConnection();
//        $results = [];
//        $query = "CALL RECSYS.RECOMMENDATIONS.GET_FILTERED_RECOMMENDATIONS('$userID', '$brand', '$section->value')";
//        $statementHandler = $databaseHandler->query($query);
//        while ($row = $statementHandler->fetch(PDO::FETCH_NUM)) {
//            $results = json_decode($row[0]);
//        }
//        return $results;
//    }
//
//    private function createConnection() : PDO
//    {
//        $account = env('DB_SNOWFLAKE_ACCOUNT');
//        $user = env('DB_SNOWFLAKE_USER_NAME');
//        $password = env('DB_SNOWFLAKE_PASSWORD');
//        $dbh = new PDO("snowflake:account=$account", $user, $password);
//        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        return $dbh;
//    }


}
