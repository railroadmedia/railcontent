<?php

namespace Railroad\Railcontent\Repositories;


class ReportedCommentRepository extends RepositoryBase
{
    /**
     * @return \Illuminate\Database\Query\Builder
     */
    public function query()
    {
        return $this->connection()->table(config('railcontent.table_prefix').'reported_comments');
    }

    public function isReportedByUserId($commentAndReplyIds, $userId)
    {
        $results = $this->query()
            ->selectRaw($this->connection()->raw('comment_id, COUNT(*) > 0 as is_reported'))
            ->whereIn('comment_id', $commentAndReplyIds)
            ->where('reporter_id', $userId)
            ->groupBy('comment_id')
            ->get()
            ->toArray();

        return array_combine(array_column($results, 'comment_id'), array_column($results, 'is_reported'));
    }
}