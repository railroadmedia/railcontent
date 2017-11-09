<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Services\ConfigService;

class CommentRepository extends RepositoryBase
{
    /**
     * If this is false the comment with all his replies will be deleted.
     * If it's true the comment with the replies are only soft deleted (marked as deleted).
     *
     * @var bool
     */
    public static $softDelete = true;

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->query()->get()->toArray();
    }

    public function delete($id)
    {
        if ($this::$softDelete) {
            return $this->softDeleteCommentWithReplies($id);
        }

        return $this->deleteCommentWithReplies($id);
    }


    /**
     * @return Builder
     */
    public function query()
    {
        return parent::connection()->table(ConfigService::$tableComments);
    }

    /**
     * @param $id
     * @return int
     */
    private function softDeleteCommentWithReplies($id)
    {
        $deleted = $this->query()
            ->where(['parent_id' => $id])
            ->orWhere(['id' => $id])
            ->update(
                [
                    'deleted_at' => Carbon::now()->toDateTimeString()
                ]
            );
        return $deleted;
    }

    /**
     * @param $id
     * @return bool
     */
    private function deleteCommentWithReplies($id)
    {
        $this->query()
            ->where(['parent_id' => $id])
            ->delete();

        $deleted = parent::delete($id);

        return $deleted;
    }
}