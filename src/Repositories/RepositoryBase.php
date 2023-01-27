<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Connection;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Services\ConfigService;

abstract class RepositoryBase
{
    /**
     * @var DatabaseManager
     */
    protected $databaseManager;

    /**
     * @var Connection
     */
    protected $connection;

    /**
     * @var Connection
     */
    public static $connectionMask;

    /**
     * @var PresenterInterface
     */
    protected $presenter;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = null;

    /**
     * Collection of Criteria
     *
     * @var Collection
     */
    protected $criteria;

    /**
     * @var bool
     */
    protected $skipPresenter = false;

    const REPOSITORYMAPPING = [
        'data' => ContentDatumRepository::class,
        'instructor' => ContentInstructorRepository::class,
        'topic' => ContentTopicRepository::class,
        'style' => ContentStyleRepository::class,
        'bpm' => ContentBpmRepository::class,
        'video' => ContentVideoRepository::class,
        'original_video' => ContentVideoRepository::class,
        'low_video' => ContentVideoRepository::class,
        'high_video' => ContentVideoRepository::class,
        'focus' => ContentFocusRepository::class
    ];

    /**
     * CategoryRepository constructor.
     */
    public function __construct()
    {
        $this->databaseManager = app('db');

        if (empty(self::$connectionMask)) {
            /**
             * @var $realConnection Connection
             */
            $realConnection = app('db')->connection(config('railcontent.database_connection_name'));
            $realConfig = $realConnection->getConfig();

            $realConfig['name'] = config('railcontent.connection_mask_prefix').$realConfig['name'];

            $maskConnection = new Connection(
                $realConnection->getPdo(),
                $realConnection->getDatabaseName(),
                $realConnection->getTablePrefix(),
                $realConfig
            );

            if (!empty($realConnection->getSchemaGrammar())) {
                $maskConnection->setSchemaGrammar($realConnection->getSchemaGrammar());
            }

            $maskConnection->setQueryGrammar($realConnection->getQueryGrammar());
            $maskConnection->setEventDispatcher($realConnection->getEventDispatcher());
            $maskConnection->setPostProcessor($realConnection->getPostProcessor());

            self::$connectionMask = $maskConnection;
        }

        $this->connection = self::$connectionMask;
    }

    /**
     * @param integer $id
     * @return array
     */
    public function getById($id)
    {
        return $this->query()
            ->where(['id' => $id])
            ->first();
    }

    /**
     * @param $key
     * @param $value
     * @param $type
     * @param $position
     * @return array
     */
    public function getByKeyValueTypePosition($key, $value, $type, $position)
    {
        return $this->query()
            ->where(['key' => $key, 'value' => $value, 'type' => $type, 'position' => $position])
            ->get()
            ->toArray();
    }

    /**
     * @param $key
     * @param $value
     * @param $type
     * @return array
     */
    public function getByKeyValueType($key, $value, $type)
    {
        return $this->query()
            ->where(['key' => $key, 'value' => $value, 'type' => $type])
            ->get()
            ->toArray();
    }

    /**
     * @param array $attributes
     * @param array $values
     * @param string $getterColumn
     * @return int|null
     */
    public function updateOrCreate(array $attributes, array $values = [], $getterColumn = 'id')
    {
        $this->query()
            ->updateOrInsert($attributes, !empty($values) ? $values : array_merge($attributes, $values));

        return $this->query()
                ->where($attributes)
                ->get([$getterColumn])
                ->first()[$getterColumn] ?? null;
    }

    /**
     * Returns new record id.
     *
     * @param array $data
     * @return int
     */
    public function create(array $data)
    {
        $existing =
            $this->query()
                ->where($data)
                ->first();

        if (empty($existing)) {
            return $this->query()
                ->insertGetId($data);
        }

        return $existing['id'];
    }

    /**
     * @param integer $id
     * @param array $data
     * @return integer
     */
    public function update($id, array $data)
    {
        $existing =
            $this->query()
                ->where(['id' => $id])
                ->first();

        if (!empty($existing)) {
            $this->query()
                ->where(['id' => $id])
                ->update($data);
        }

        return $id;
    }

    /**
     * @param null $dataId
     * @param $data
     * @return bool|int
     */
    public function createOrUpdateAndReposition($dataId = null, $data)
    {
        $existingData =
            $this->query()
                ->where('id', $dataId)
                ->get()
                ->first();

        $contentId = $existingData['content_id'] ?? $data['content_id'];
        $key = $existingData['key'] ?? $data['key'];

        $dataCount =
            $this->query()
                ->where([
                            'content_id' => $contentId,
                            'key' => $key,
                        ])
                ->count();

        $data['position'] = $this->recalculatePosition(
            $data['position'] ?? $existingData['position'],
            $dataCount,
            $existingData
        );

        if (empty($existingData)) {
            $this->incrementOtherEntitiesPosition(
                null,
                $contentId,
                $key,
                $data['position'],
                null
            );

            return $this->query()
                ->insertGetId($data);
        } elseif ($data['position'] > $existingData['position']) {
            $this->query()
                ->where('id', $dataId)
                ->update($data);

            return $this->decrementOtherEntitiesPosition(
                $dataId,
                $contentId,
                $key,
                $existingData['position'],
                $data['position']
            );
        } elseif ($data['position'] < $existingData['position']) {
            $updated =
                $this->query()
                    ->where('id', $dataId)
                    ->update($data);

            $this->incrementOtherEntitiesPosition(
                $dataId,
                $contentId,
                $key,
                $data['position'],
                $existingData['position']
            );

            return $updated;
        } else {
            return $this->query()
                ->where('id', $dataId)
                ->update($data);
        }
    }

    /**
     * Delete a record.
     *
     * @param integer $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->query()
                ->where(['id' => $id])
                ->delete() > 0;
    }

    /**
     * @param $entity
     * @param string $positionColumnPrefix
     * @return bool
     */
    public function deleteAndReposition($entity, $positionColumnPrefix = '')
    {
        $existingLink =
            $this->query()
                ->where($entity)
                ->first();

        if (empty($existingLink)) {
            return true;
        }

        $query = $this->query();
        if (array_key_exists('content_id', $existingLink)) {
            $query->where([
                              'content_id' => $existingLink['content_id'],
                              'key' => $existingLink['key'],
                          ]);
        }

        if (array_key_exists('parent_id', $existingLink)) {
            $query->where('parent_id', $existingLink['parent_id']);
        }

        $query->where(
            $positionColumnPrefix.'position',
            '>',
            $existingLink[$positionColumnPrefix."position"]
        )
            ->decrement($positionColumnPrefix.'position');

        $deleted =
            $this->query()
                ->where(['id' => $existingLink['id']])
                ->delete();

        return $deleted > 0;
    }

    /**
     * @return Builder
     */
    public abstract function query();

    /**
     * @return Connection
     */
    public function connection()
    {
        return $this->connection;
    }

    /**
     * @param $position
     * @param $dataCount
     * @param $existingData
     * @return mixed
     */
    public function recalculatePosition($position, $dataCount, $existingData)
    {
        if ($position === null || $position > $dataCount) {
            if (empty($existingData)) {
                $position = $dataCount + 1;
            } else {
                $position = $dataCount;
            }
        }

        if ($position < 1) {
            $position = 1;
        }

        return $position;
    }

    private function incrementOtherEntitiesPosition(
        $excludedEntityId = null,
        $contentId,
        $key,
        $startPosition,
        $endPosition = null
    ) {
        $query =
            $this->query()
                ->where('content_id', $contentId)
                ->where('key', $key)
                ->where('position', '>=', $startPosition);

        if ($excludedEntityId) {
            $query->where('id', '!=', $excludedEntityId);
        }

        if ($endPosition) {
            $query->where('position', '<', $endPosition);
        }

        return $query->increment('position') > 0;
    }

    private function decrementOtherEntitiesPosition(
        $excludedEntityId,
        $contentId,
        $key,
        $startPosition,
        $endPosition
    ) {
        return $this->query()
                ->where('content_id', $contentId)
                ->where('key', $key)
                ->where('id', '!=', $excludedEntityId)
                ->where('position', '>', $startPosition)
                ->where('position', '<=', $endPosition)
                ->decrement('position') > 0;
    }

    /**
     * Specify Presenter class name
     *
     * @return string
     */
    public function presenter()
    {
        return null;
    }

    /**
     * @param $presenter
     * @return $this
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function setPresenter($presenter)
    {
        $this->makePresenter($presenter);

        return $this;
    }

    /**
     * @param null $presenter
     * @return mixed|PresenterInterface|string|null
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function makePresenter($presenter = null)
    {
        $presenter = !is_null($presenter) ? $presenter : $this->presenter();

        if (!is_null($presenter)) {
            $this->presenter = is_string($presenter) ? app()->make($presenter) : $presenter;

            return $this->presenter;
        }

        return null;
    }

    /**
     * Wrapper result data
     *
     * @param mixed $result
     *
     * @return mixed
     */
    public function parserResult($result)
    {
        if ($this->presenter) {
            return $this->presenter->transform($result);
        }

        return $result;
    }

    /**
     * @param $contentRows
     * @param false $withoutAssociatedJoin
     * @return array
     */
    public function getFieldsByContentIds($contentRows, $withoutAssociatedJoin = false)
    {
        $instructors = [];
        $styles = [];
        $bpm = [];
        $topics = [];
        $videos = [];

        if (!$withoutAssociatedJoin) {
            $videos = [];
            //$this->getVideoForContents(array_column($contentRows, 'id'));
            $instructors = [];
            //$this->getInstructorsForContents(array_column($contentRows, 'id'));

            $styles =
                $this->query()
                    ->select([
                                 config('railcontent.table_prefix').'content_styles'.'.style as field_value',
                                 config('railcontent.table_prefix').'content'.'.id',
                             ])
                    ->join(
                        config('railcontent.table_prefix').'content_styles',
                        config('railcontent.table_prefix').'content'.'.id',
                        '=',
                        config('railcontent.table_prefix').'content_styles'.'.content_id'
                    )
                    ->whereIn(
                        config('railcontent.table_prefix').'content'.'.id',
                        array_column($contentRows, 'id')
                    )
                    ->get()
                    ->groupBy('id')
                    ->toArray();

            $bpm =
                $this->query()
                    ->select([
                                 config('railcontent.table_prefix').'content_bpm'.'.bpm as field_value',
                                 config('railcontent.table_prefix').'content'.'.id',
                             ])
                    ->join(
                        config('railcontent.table_prefix').'content_bpm',
                        config('railcontent.table_prefix').'content'.'.id',
                        '=',
                        config('railcontent.table_prefix').'content_bpm'.'.content_id'
                    )
                    ->whereIn(
                        config('railcontent.table_prefix').'content'.'.id',
                        array_column($contentRows, 'id')
                    )
                    ->get()
                    ->groupBy('id')
                    ->toArray();

            $topics =
                $this->query()
                    ->select([
                                 config('railcontent.table_prefix').'content_topics'.'.topic as field_value',
                                 config('railcontent.table_prefix').'content'.'.id',
                             ])
                    ->join(
                        config('railcontent.table_prefix').'content_topics',
                        config('railcontent.table_prefix').'content'.'.id',
                        '=',
                        config('railcontent.table_prefix').'content_topics'.'.content_id'
                    )
                    ->whereIn(
                        config('railcontent.table_prefix').'content'.'.id',
                        array_column($contentRows, 'id')
                    )
                    ->get()
                    ->groupBy('id')
                    ->toArray();
        }

        $fieldsColumns = config('railcontent.contentColumnNamesForFields', []);

        $fields = [];

        foreach ($contentRows as $contentRow) {
            $fields[$contentRow['id']] = [];

            foreach ($fieldsColumns as $column) {
                if ($column != 'video') {
                    $fields[$contentRow['id']][] = [
                        "content_id" => $contentRow['id'],
                        "key" => $column,
                        "value" => $contentRow[$column] ?? '',
                        "type" => "string",
                        "position" => 1,
                    ];
                }
            }

            if (array_key_exists($contentRow['id'], $instructors)) {
                foreach ($instructors[$contentRow['id']] as $index => $instructor) {
                    $fields[$contentRow['id']][] = [
                        "content_id" => $contentRow['id'],
                        "key" => 'instructor',
                        "value" => $instructor,
                        "type" => "content",
                        "position" => $index,
                    ];
                }
            }

            if (array_key_exists($contentRow['id'], $styles)) {
                foreach ($styles[$contentRow['id']] as $index => $style) {
                    $fields[$contentRow['id']][] = [
                        "content_id" => $contentRow['id'],
                        "key" => 'style',
                        "value" => $style['field_value'] ?? '',
                        "type" => "string",
                        "position" => $index,
                    ];
                }
            }

            if (array_key_exists($contentRow['id'], $bpm)) {
                foreach ($bpm[$contentRow['id']] as $index => $bpmRow) {
                    $fields[$contentRow['id']][] = [
                        "content_id" => $contentRow['id'],
                        "key" => 'bpm',
                        "value" => $bpmRow['field_value'] ?? '',
                        "type" => "integer",
                        "position" => $index,
                    ];
                }
            }

            if (array_key_exists($contentRow['id'], $topics)) {
                foreach ($topics[$contentRow['id']] as $index => $topic) {
                    $fields[$contentRow['id']][] = [
                        "content_id" => $contentRow['id'],
                        "key" => 'topic',
                        "value" => $topic['field_value'] ?? '',
                        "type" => "integer",
                        "position" => $index,

                    ];
                }
            }

            if (array_key_exists($contentRow['id'], $videos)) {
                foreach ($videos[$contentRow['id']] as $index => $video) {
                    $fields[$contentRow['id']][] = [
                        "content_id" => $contentRow['id'],
                        "key" => 'video',
                        "value" => $video,
                        "type" => "content",
                        "position" => $index,
                    ];
                }
            }
        }

        return $fields;
    }

    public function geExtraDataInOldStyle($extraKeys, $contentRows)
    {
        $results = [];
        foreach ($extraKeys as $key) {
            if (array_key_exists($key, self::REPOSITORYMAPPING)) {
                $repositoryName = self::REPOSITORYMAPPING[$key];
                if ($repositoryName) {
                    $repository = app()->make($repositoryName);
                    $results[$key] = $repository->getByContentIds(array_column($contentRows, 'id'), $key);
                    if($key == 'data' ){
                        $results[$key] = ContentHelper::groupArrayBy($results[$key], 'content_id');
                    }
                }
            }
        }

        return $results;
    }
}