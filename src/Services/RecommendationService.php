<?php

namespace Railroad\Railcontent\Services;

use Exception;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\Http;
use PDO;
use Railroad\Railcontent\Enums\RecommenderSection;

enum AccessMethod {
    case PDO;
    case DB;
    case HUGGINGFACE;
}

class RecommendationService
{

    public AccessMethod $accessMethod;

    public function __construct(
        private DatabaseManager $databaseManager,
    ) {
        $this->accessMethod = AccessMethod::HUGGINGFACE;
        $this->invalidConfigurations = [
            'pianote' => [RecommenderSection::Course],
            'singeo' => [RecommenderSection::Course],
        ];
    }

    public function getRawTable() : array
    {
        $results = [];
        $sth = $this->createConnection()->query(
            "select * FROM RECSYS.RECOMMENDATIONS.DRUMEO_COURSE_RECOMMENDATIONS LIMIT 10"
        );
        while ($row = $sth->fetch(PDO::FETCH_NUM)) {
            $results[] = $this->unpackRecommendationRow($row);
        }
        return $results;
    }

    public function getFilteredRecommendations($userID, $brand, RecommenderSection $section)
    {
        if ($this->hasNoResults($brand, $section)) {
            return [];
        }
        return match($this->accessMethod)
        {
            AccessMethod::PDO => $this->getFilteredRecommendationsUsingPDO($userID, $brand, $section),
            AccessMethod::DB => $this->getFilteredRecommendationsUsingDBHandler($userID, $brand, $section),
            AccessMethod::HUGGINGFACE => $this->getFilteredRecommendationsUsingHuggingFace([$userID], $brand, $section)[$userID],
        };
    }

    private function hasNoResults($brand, $section): bool
    {
        $brand = strtolower($brand);
        return isset($this->invalidConfigurations[$brand]) && in_array($section, $this->invalidConfigurations[$brand]);
    }

    private function getFilteredRecommendationsUsingPDO($userID, $brand, RecommenderSection $section) : array
    {
        $connection = $this->databaseManager->connection('snowflake_pdo');
        $query = "CALL RECSYS.RECOMMENDATIONS.GET_FILTERED_RECOMMENDATIONS('$userID', '$brand', '$section->value')";
        try {
            $result = $connection->select($query);
            $contentIDs = json_decode($result[0]->GET_FILTERED_RECOMMENDATIONS);
        } catch (Exception $e) {
            error_log($e);
            $contentIDs = [];
        }
        return $contentIDs;
    }

    public function getBulkFilterRecommendations($userIDs, $brand, RecommenderSection $section) : array
    {

        $connection = $this->databaseManager->connection('snowflake_pdo');
        $content = [];
        $idString = implode(',', $userIDs);
        $query = "CALL RECSYS.RECOMMENDATIONS.GET_BATCH_FILTERED_RECOMMENDATIONS([$idString], '$brand', '$section->value')";
        try {
            $result = $connection->select($query);
            $content = json_decode($result[0]->GET_BATCH_FILTERED_RECOMMENDATIONS);
        } catch (Exception $e) {
            error_log($e);
        }
        return $content;

    }

    private function getFilteredRecommendationsUsingDBHandler($userID, $brand, RecommenderSection $section) : array
    {
        $databaseHandler = $this->createConnection();
        $results = [];
        $query = "CALL RECSYS.RECOMMENDATIONS.GET_FILTERED_RECOMMENDATIONS('$userID', '$brand', '$section->value')";
        $statementHandler = $databaseHandler->query($query);
        while ($row = $statementHandler->fetch(PDO::FETCH_NUM)) {
            $results = json_decode($row[0]);
        }
        return $results;
    }

    private function createConnection() : PDO
    {
        $account = env('DB_SNOWFLAKE_ACCOUNT');
        $user = env('DB_SNOWFLAKE_USER_NAME');
        $password = env('DB_SNOWFLAKE_PASSWORD');
        $dbh = new PDO("snowflake:account=$account", $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbh;
    }

    private function unpackRecommendationRow($row) : array
    {
        return [ 'userID' => $row[0],
            'contentID' => $row[1],
            'rank' => $row[2],
        ];
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
        if ($response->status() != 200) {
            \Log::info($response);
        }
        if ($response->status() == 503) {
            // service unavailable, retry once
            $response = Http::withToken($authToken)->post($url, $data);
        }
        $content = $response->json();
        if (!$content) {
            $content = [];
            foreach($userIDs as $userID) {
                $content[$userID] = [];
            }
        }
        return $content;
    }
}
