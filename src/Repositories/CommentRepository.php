<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Services\ConfigService;

class CommentRepository extends RepositoryBase
{
    /** The value it's set in ContentPermissionMiddleware: if the user it's admin the value it's false, otherwise it's true.
     * If the value it' is false the comment with all his replies will be deleted.
     * If it's true the comment with the replies are only soft deleted (marked as deleted).
     *
     * @var bool
     */
    public static $softDelete = true;

    /** Based on softDelete we soft delete or permanently delete the comment with all his replies
     * @param int $id
     * @return bool|int
     */
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

    /** Mark comment and it's replies as deleted
     * @param integer $id
     * @return bool
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

    /** Delete comment and it's replies
     * @param integer $id
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