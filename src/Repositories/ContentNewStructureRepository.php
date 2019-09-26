<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Repositories\Traits\ByContentIdTrait;
use Railroad\Railcontent\Services\ConfigService;

class ContentNewStructureRepository extends RepositoryBase
{
    use ByContentIdTrait;

    /**
     * @var ContentTagRepository
     */
    private $contentTagRepository;

    /**
     * @var ContentTopicRepository
     */
    private $contentTopicRepository;

    /**
     * @var ContentKeyRepository
     */
    private $contentKeyRepository;

    /**
     * @var ContentKeyPitchTypeRepository
     */
    private $contentKeyPitchTypeRepository;

    /**
     * @var ContentInstructorRepository
     */
    private $contentInstructorRepository;

    /**
     * @var ContentExerciseRepository
     */
    private $contentExerciseRepository;

    /**
     * @var ContentPlaylistRepository
     */
    private $contentPlaylistRepository;

    /**
     * @var ContentDatumRepository
     */
    private $contentDatumRepository;

    /**
     * ContentNewStructureRepository constructor.
     *
     * @param ContentTagRepository $contentTagRepository
     * @param ContentTopicRepository $contentTopicRepository
     * @param ContentKeyRepository $contentKeyRepository
     * @param ContentKeyPitchTypeRepository $contentKeyPitchTypeRepository
     * @param ContentInstructorRepository $contentInstructorRepository
     * @param ContentExerciseRepository $contentExerciseRepository
     * @param ContentPlaylistRepository $contentPlaylistRepository
     * @param ContentDatumRepository $contentDatumRepository
     */
    public function __construct(
        ContentTagRepository $contentTagRepository,
        ContentTopicRepository $contentTopicRepository,
        ContentKeyRepository $contentKeyRepository,
        ContentKeyPitchTypeRepository $contentKeyPitchTypeRepository,
        ContentInstructorRepository $contentInstructorRepository,
        ContentExerciseRepository $contentExerciseRepository,
        ContentPlaylistRepository $contentPlaylistRepository,
        ContentDatumRepository $contentDatumRepository
    ) {

        parent::__construct();

        $this->contentTagRepository = $contentTagRepository;
        $this->contentTopicRepository = $contentTopicRepository;
        $this->contentKeyRepository = $contentKeyRepository;
        $this->contentKeyPitchTypeRepository = $contentKeyPitchTypeRepository;
        $this->contentInstructorRepository = $contentInstructorRepository;
        $this->contentExerciseRepository = $contentExerciseRepository;
        $this->contentPlaylistRepository = $contentPlaylistRepository;
        $this->contentDatumRepository = $contentDatumRepository;
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return $this->connection()
            ->table(ConfigService::$tableContent);
    }

    /**
     * @param integer $contentId
     * @return array
     */
    public function getByContentId($contentId)
    {
        if (empty($contentId)) {
            return [];
        }

        $tags = $this->contentTagRepository->getByContentId($contentId);
        $topics = $this->contentTopicRepository->getByContentId($contentId);
        $keys = $this->contentKeyRepository->getByContentId($contentId);
        $keysPitchTypes = $this->contentKeyPitchTypeRepository->getByContentId($contentId);
        $instructors = $this->contentInstructorRepository->getByContentId($contentId);
        $assignments = $this->contentExerciseRepository->getByContentId($contentId);
        $contentPlaylists = $this->contentPlaylistRepository->getByContentId($contentId);
        $sbtBpmAndSbtExercises =
            $this->contentDatumRepository->getByKeysAndContentId(['sbt_exercise_number', 'sbt_bpm'], $contentId);

        return array_merge(
            $tags,
            $topics,
            $keys,
            $keysPitchTypes,
            $instructors,
            $assignments,
            $contentPlaylists,
            $sbtBpmAndSbtExercises
        );
    }

    /**
     * @param array $contentIds
     * @return array
     */
    public function getByContentIds(array $contentIds)
    {
        if (empty($contentIds)) {
            return [];
        }

        $contentIds = array_unique($contentIds);

        $tags = $this->contentTagRepository->getByContentIdsQuery($contentIds);
        $topics = $this->contentTopicRepository->getByContentIdsQuery($contentIds);
        $keysPitchTypes = $this->contentKeyPitchTypeRepository->getByContentIdsQuery($contentIds);
        $playlists = $this->contentPlaylistRepository->getByContentIdsQuery($contentIds);
        $instructors = $this->contentInstructorRepository->getByContentIdsQuery($contentIds);
        $assignments = $this->contentExerciseRepository->getByContentIdsQuery($contentIds);
        $sbt =
            $this->contentDatumRepository->getByKeysAndContentIdsQuery(['sbt_exercise_number', 'sbt_bpm'], $contentIds);

        $results =
            $this->contentKeyRepository->getByContentIdsQuery($contentIds)
                ->unionAll($topics)
                ->unionAll($keysPitchTypes)
                ->unionAll($playlists)
                ->unionAll($instructors)
                ->unionAll($assignments)
                ->unionAll($tags)
                ->unionAll($sbt);

        return $results->get()
            ->toArray();
    }

    /**
     * @param null $dataId
     * @param $data
     * @param bool $isEAV
     * @return bool|int
     */
    public function createOrUpdateAndReposition($dataId = null, $data, $isEAV = true)
    {
        if (array_key_exists(
            $data['key'],
            config('railcontentNewStructure.content_associations', [])
        )) {
            $repository = 'content' . (ucfirst(str_replace('_', '', ucwords($data['key'], "_")))) . 'Repository';

            $reponse = $this->$repository->createOrUpdateAndReposition($dataId, $data, false);

            return $reponse;
        }

        return parent::createOrUpdateAndReposition($dataId, $data, $isEAV = true);
    }

    /**
     * @param int $id
     * @param string $key
     * @return array
     */
    public function getById($id, $key = '')
    {
        if (array_key_exists(
            $key,
            config('railcontentNewStructure.content_associations', [])
        )) {
            $repository = 'content' . (ucfirst(str_replace('_', '', ucwords($key, "_")))) . 'Repository';
            return $this->$repository->getById($id);
        }

        return parent::getById($id);
    }

    /**
     * @param $entity
     * @param string $positionColumnPrefix
     * @param string $key
     * @param bool $isEAV
     * @return bool
     */
    public function deleteAndReposition($entity, $positionColumnPrefix = '', $key = '', $isEAV = false)
    {
        $repository = 'content' . (ucfirst(str_replace('_', '', ucwords($key, "_")))) . 'Repository';

        return $this->$repository->deleteAndReposition($entity, $positionColumnPrefix = '', $isEAV = false);
    }
}