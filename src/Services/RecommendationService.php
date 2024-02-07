<?php

namespace Railroad\Railcontent\Services;


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

    public AccessMethod $accessMethod;
    private array $RETRY_ERROR_CODES = [500, 503];

    public function __construct(
        //private DatabaseManager $databaseManager,
    ) {
        $this->accessMethod = AccessMethod::HUGGINGFACE;
        $this->invalidConfigurations = [
            'pianote' => [RecommenderSection::Course],
            'singeo' => [RecommenderSection::Course],
        ];
    }

    public function getFilteredRecommendations($userID, $brand, RecommenderSection $section)
    {
        if ($this->hasNoResults($brand, $section)) {
            return [];
        }
        return $this->getFilteredRecommendationsUsingHuggingFace([$userID], $brand, $section)[$userID];
//        return match($this->accessMethod)
//        {
//            AccessMethod::PDO => $this->getFilteredRecommendationsUsingPDO($userID, $brand, $section),
//            AccessMethod::DB => $this->getFilteredRecommendationsUsingDBHandler($userID, $brand, $section),
//            AccessMethod::HUGGINGFACE => $this->getFilteredRecommendationsUsingHuggingFace([$userID], $brand, $section)[$userID],
//        };
    }

    private function hasNoResults($brand, $section): bool
    {
        $brand = strtolower($brand);
        return isset($this->invalidConfigurations[$brand]) && in_array($section, $this->invalidConfigurations[$brand]);
    }

    private function getFilteredRecommendationsUsingHuggingFace($userIDs, $brand, RecommenderSection $section)
    {
        $url = env('HUGGINGFACE_URL');
        $authToken = env('HUGGINGFACE_TOKEN');
        $data = [
            'user_ids' => $userIDs,
            'brand' => $brand,
            'section' => $section->value
        ];

        $response = Http::withToken($authToken)->post($url, $data);
        if (in_array($response->status(), $this->RETRY_ERROR_CODES)) {
            $response = Http::withToken($authToken)->post($url, $data);
        }
        $content = $response->json();
        if (!$content) {
            $status = $response->status();
            Log::warning("HuggingFace return an unexpected response with code: $status");
            $content = [];
            foreach($userIDs as $userID) {
                $content[$userID] = [];
            }
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
//
//    }extra
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
