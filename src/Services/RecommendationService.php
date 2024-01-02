<?php

namespace App\Modules\RecommendationSystem\Services;

use App\Enums\RecommenderSection;
use App\Modules\RecommendationSystem\Models\Recommendation;
use Exception;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;
use PDO;


class RecommendationService
{

    public bool $usePDO;

    public function __construct(
        private DatabaseManager $databaseManager,
    ) {
        $this->usePDO = true;
    }

    public function getRawTable()
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
        if ($this->usePDO) {
            return  $this->getFilteredRecommendationsUsingPDO($userID, $brand, $section);
        } else {
            return  $this->getFilteredRecommendationsUsingDBHandler($userID, $brand, $section);
        }
    }

    private function getFilteredRecommendationsUsingPDO($userID, $brand, RecommenderSection $section)
    {

        $connection = $this->databaseManager->connection('snowflake_pdo');
        try {
            $result = $connection->select(
                'CALL RECSYS.RECOMMENDATIONS.GET_FILTERED_RECOMMENDATIONS(?,?,?)',
                array($userID, $brand, $section->value)

            );
            $contentIDs = json_decode($result[0]->GET_FILTERED_RECOMMENDATIONS);
        } catch (Exception $e) {
            error_log($e);
            $contentIDs = [];
        }
        //TODO null + error handling
        return $contentIDs;
    }

    private function getFilteredRecommendationsUsingDBHandler($userID, $brand, RecommenderSection $section)
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

    private function createConnection()
    {
        $account = env('DB_SNOWFLAKE_ACCOUNT');
        $user = env('DB_SNOWFLAKE_USER_NAME');
        $password = env('DB_SNOWFLAKE_PASSWORD');
        $dbh = new PDO("snowflake:account=$account", $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbh;
    }

    private function unpackRecommendationRow($row)
    {
        return new Recommendation($row[0], $row[1], $row[2]);
    }
}
