<?php

namespace Railroad\Railcontent\Repositories;

use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Transformers\InstructorTransformer;

class ContentInstructorRepository extends RepositoryBase
{
    /**
     * @var ContentDatumRepository
     */
    private $datumRepository;

    public function __construct(
        ContentDatumRepository $datumRepository
    ) {
        parent::__construct();

        $this->datumRepository = $datumRepository;
    }

    public function query()
    {
        return $this->connection()
            ->table(config('railcontent.table_prefix').'content_instructors');
    }

    public function getByContentIds($contentIds)
    {
        if (empty($contentIds)) {
            return [];
        }
        if (!is_array($contentIds)) {
            $contentIds = [$contentIds];
        }

        $data =
            $this->query()
                ->join(
                    config('railcontent.table_prefix').'content',
                    'instructor_id',
                    '=',
                    config('railcontent.table_prefix').'content.id'
                )
                ->whereIn('content_id', $contentIds)
                ->orderBy('position', 'asc')
                ->get()
                ->toArray();

        $contentDatumRows = $this->datumRepository->getByContentIds(array_column($data, 'instructor_id'));
        $parser = $this->setPresenter(InstructorTransformer::class);
        $parser->presenter->addParam(['data' => ContentHelper::groupArrayBy($contentDatumRows, 'content_id')]);

        return $this->parserResult($data);
    }
}