<?php

namespace Railroad\Railcontent\Commands;

use Illuminate\Database\Connection;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Railroad\Railcontent\Managers\RailcontentEntityManager;

class MigrateContentFields extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:migrateFields';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate content fields to the new structure';

    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * @var RailcontentEntityManager
     */
    private $entityManager;

    /**
     * MigrateContentFields constructor.
     *
     * @param DatabaseManager $databaseManager
     * @param RailcontentEntityManager $entityManager
     */
    public function __construct(DatabaseManager $databaseManager, RailcontentEntityManager $entityManager)
    {
        parent::__construct();

        $this->databaseManager = $databaseManager;

        $this->entityManager = $entityManager;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $dbConnection = $this->databaseManager->connection(config('railcontent.database_connection_name'));
        $dbConnection->disableQueryLog();
        $pdo = $dbConnection->getPdo();
        $pdo->exec('SET TRANSACTION ISOLATION LEVEL READ COMMITTED');

        $this->info('Migrate fields command starting.');

        $this->migrateTopics($dbConnection);

        $this->info('Ending content topics migration. ');

        $this->migrateTags($dbConnection);

        $this->info('Ending content tags migration.');

        $this->migrateSBTFields($dbConnection);

        $this->info('Ending content sbt_bpm and sbt_exercise_number migration. ');

        $this->migrateContentPlaylist($dbConnection);

        $this->info('Ending content playlists migration.');

        $this->migrateContentKeys($dbConnection);

        $this->info('Ending content keys migration. ');

        $this->migrateContentKeyPitchType($dbConnection);

        $this->info('Ending content key pitch types migration.');

        $this->migrateExercise($dbConnection);

        $this->info('Ending content exercise migration.');

        $this->info('Migration completed. ');
    }

    /**
     * @param Connection $dbConnection
     * @return string|void
     */
    private function migrateTopics(Connection $dbConnection)
    {
        $sql = <<<'EOT'
INSERT INTO %s (
    `content_id`,
    `topic`,
    `position`
)
SELECT
    c.`content_id` AS `content_id`,
    c.`value` AS `topic`,
    c.`position` AS `position`
FROM `%s` c
WHERE
    c.`key` IN ('%s')
    AND  c.`value` is not null
EOT;

        $statement = sprintf(
            $sql,
            config('railcontent.table_prefix') . 'content_topic',
            config('railcontent.table_prefix') . 'content_fields',
            'topic'
        );

        $dbConnection->statement($statement);
        return $statement;
    }

    /**
     * @param Connection $dbConnection
     * @return string|void
     */
    private function migrateTags(Connection $dbConnection)
    {
        $sql = <<<'EOT'
INSERT INTO %s (
    `content_id`,
    `tag`,
    `position`
)
SELECT
    c.`content_id` AS `content_id`,
    c.`value` AS `tag`,
    c.`position` AS `position`
FROM `%s` c
WHERE
    c.`key` IN ('%s')
    AND  c.`value` is not null
EOT;

        $statement = sprintf(
            $sql,
            config('railcontent.table_prefix') . 'content_tag',
            config('railcontent.table_prefix') . 'content_fields',
            'tag'
        );

        $dbConnection->statement($statement);
        return $statement;
    }

    /**
     * @param Connection $dbConnection
     * @return string|void
     */
    private function migrateSBTFields(Connection $dbConnection)
    {
        $sql = <<<'EOT'
INSERT INTO %s (
    `content_id`,
    `value`,
    `key`,
    `position`
)
SELECT
    c.`content_id` AS `content_id`,
    c.`value` AS `tag`,
    c.`key` AS `key`,
    c.`position` AS `position`
FROM `%s` c
WHERE
    c.`key` IN ('%s')
    AND  c.`value` is not null
EOT;

        $statement = sprintf(
            $sql,
            config('railcontent.table_prefix') . 'content_data',
            config('railcontent.table_prefix') . 'content_fields',
            implode(", ", ['sbt_bpm', 'sbt_exercise_number'])
        );

        $dbConnection->statement($statement);
        return $statement;
    }

    /**
     * @param Connection $dbConnection
     * @return string|void
     */
    private function migrateContentPlaylist(Connection $dbConnection)
    {
        $sql = <<<'EOT'
INSERT INTO %s (
    `content_id`,
    `playlist`,
    `position`
)
SELECT
    c.`content_id` AS `content_id`,
    c.`value` AS `playlist`,
    c.`position` AS `position`
FROM `%s` c
WHERE
    c.`key` IN ('%s')
    AND  c.`value` is not null
EOT;

        $statement = sprintf(
            $sql,
            config('railcontent.table_prefix') . 'content_playlist',
            config('railcontent.table_prefix') . 'content_fields',
            'playlist'
        );

        $dbConnection->statement($statement);
        return $statement;
    }

    /**
     * @param Connection $dbConnection
     * @return string|void
     */
    private function migrateContentKeys(Connection $dbConnection)
    {
        $sql = <<<'EOT'
INSERT INTO %s (
    `content_id`,
    `key`,
    `position`
)
SELECT
    c.`content_id` AS `content_id`,
    c.`value` AS `key`,
    c.`position` AS `position`
FROM `%s` c
WHERE
    c.`key` IN ('%s')
    AND  c.`value` is not null
EOT;

        $statement = sprintf(
            $sql,
            config('railcontent.table_prefix') . 'content_key',
            config('railcontent.table_prefix') . 'content_fields',
            'key'
        );

        $dbConnection->statement($statement);
        return $statement;
    }

    /**
     * @param Connection $dbConnection
     * @return string|void
     */
    private function migrateContentKeyPitchType(Connection $dbConnection)
    {
        $sql = <<<'EOT'
INSERT INTO %s (
    `content_id`,
    `key_pitch_type`,
    `position`
)
SELECT
    c.`content_id` AS `content_id`,
    c.`value` AS `key_pitch_type`,
    c.`position` AS `position`
FROM `%s` c
WHERE
    c.`key` IN ('%s')
    AND  c.`value` is not null
EOT;

        $statement = sprintf(
            $sql,
            config('railcontent.table_prefix') . 'content_key_pitch_type',
            config('railcontent.table_prefix') . 'content_fields',
            'key_pitch_type'
        );

        $dbConnection->statement($statement);
        return $statement;
    }

    /**
     * @param Connection $dbConnection
     * @return string|void
     */
    private function migrateExercise(Connection $dbConnection)
    {
        $sql = <<<'EOT'
INSERT INTO %s (
    `content_id`,
    `exercise_id`,
    `position`
)
SELECT
    c.`content_id` AS `content_id`,
    c.`value` AS `exercise_id`,
    c.`position` AS `position`
FROM `%s` c
WHERE
    c.`key` IN ('%s')
    AND  c.`value` is not null
EOT;

        $statement = sprintf(
            $sql,
            config('railcontent.table_prefix') . 'content_exercise',
            config('railcontent.table_prefix') . 'content_fields',
            'exercise_id'
        );

        $dbConnection->statement($statement);
        return $statement;
    }



}
