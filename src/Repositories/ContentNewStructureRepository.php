<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Repositories\Traits\ByContentIdTrait;

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
    private $contentInstructorsRepository;

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
        $this->contentTagRepository = $contentTagRepository;
        $this->contentTopicRepository = $contentTopicRepository;
        $this->contentKeyRepository = $contentKeyRepository;
        $this->contentKeyPitchTypeRepository = $contentKeyPitchTypeRepository;
        $this->contentInstructorsRepository = $contentInstructorRepository;
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
            ->table('railcontent_content_tag');
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
        $instructors = $this->contentInstructorsRepository->getByContentId($contentId);
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
        $tags = $this->contentTagRepository->getByContentIds($contentIds);
        $topics = $this->contentTopicRepository->getByContentIds($contentIds);
        $keys = $this->contentKeyRepository->getByContentIds($contentIds);
        $keysPitchTypes = $this->contentKeyPitchTypeRepository->getByContentIds($contentIds);
        $instructors = $this->contentInstructorsRepository->getByContentIds($contentIds);
        $assignments = $this->contentExerciseRepository->getByContentIds($contentIds);
        $contentPlaylists = $this->contentPlaylistRepository->getByContentIds($contentIds);
        $sbtBpmAndSbtExercises =
            $this->contentDatumRepository->getByKeysAndContentIds(['sbt_exercise_number', 'sbt_bpm'], $contentIds);

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
}