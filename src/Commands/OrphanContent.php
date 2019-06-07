<?php

namespace Railroad\Railcontent\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use Railroad\Railcontent\Services\CommentService;
use Railroad\Railcontent\Services\ContentDatumService;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Services\ContentLikeService;
use Railroad\Railcontent\Services\ContentPermissionService;

class OrphanContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'OrphanContent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Purge all orphans';

    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    private $connection;

    /**
     * @var ContentHierarchyService
     */
    private $contentHierarchyService;

    /**
     * @var ContentDatumService
     */
    private $contentDataService;

    /**
     * @var ContentLikeService
     */
    private $contentLikeService;

    /**
     * @var ContentPermissionService
     */
    private $contentPermissionService;

    /**
     * @var CommentService
     */
    private $commentService;

    /**
     * OrphanContent constructor.
     *
     * @param DatabaseManager $databaseManager
     * @param ContentHierarchyService $contentHierarchyService
     * @param ContentDatumService $contentDataService
     * @param ContentLikeService $contentLikeService
     * @param ContentPermissionService $contentPermissionService
     * @param CommentService $commentService
     */
    public function __construct(
        DatabaseManager $databaseManager,
        ContentHierarchyService $contentHierarchyService,
        ContentDatumService $contentDataService,
        ContentLikeService $contentLikeService,
        ContentPermissionService $contentPermissionService,
        CommentService $commentService
    ) {
        parent::__construct();

        $this->databaseManager = $databaseManager;

        $this->contentHierarchyService = $contentHierarchyService;
        $this->contentDataService = $contentDataService;
        $this->contentLikeService = $contentLikeService;
        $this->contentPermissionService = $contentPermissionService;
        $this->commentService = $commentService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Purge all orphan contents.');

        $this->connection = $this->databaseManager->connection(config('railcontent.database_connection_name'));
        $this->connection->disableQueryLog();

        $this->getOrphansFromHierarchies();
        $this->getOrphansFromContentData();
        $this->getOrphansFromContentLikes();
        $this->getOrphansFromContentPermissions();
        $this->getOrphansFromComments();

        $this->info('Finished orphan contents removal.');

        return true;
    }

    public function getOrphansFromHierarchies()
    {
        $i = 0;
        $this->connection->table(config('railcontent.table_prefix') . 'content_hierarchy as content_hierarchy')
            ->select('content_hierarchy.id', 'content_hierarchy.child_id', 'content_hierarchy.parent_id')
            ->leftJoin(
                config('railcontent.table_prefix') . 'content as content',
                'content_hierarchy.child_id',
                'content.id'
            )
            ->whereNull('content.id')
            ->orderBy('content_hierarchy.child_id', 'asc')
            ->chunk(
                10000,
                function (Collection $rows) use (&$i) {
                    foreach ($rows as $row) {
                        $i++;
                        $this->error(
                            'Delete hierarchy with parentId:' . $row->parent_id . ' and childId:' . $row->child_id
                        );
                        $this->contentHierarchyService->delete($row->parent_id, $row->child_id);
                    }
                }
            );

        $this->info('Total hierarchies deleted: ' . $i);
    }

    public function getOrphansFromContentData()
    {
        $i = 0;
        $this->connection->table(config('railcontent.table_prefix') . 'content_data as content_data')
            ->select('content_data.id', 'content_data.content_id')
            ->leftJoin(
                config('railcontent.table_prefix') . 'content as content',
                'content_data.content_id',
                'content.id'
            )
            ->whereNull('content.id')
            ->orderBy('content_data.id', 'asc')
            ->chunk(
                10000,
                function (Collection $rows) use (&$i) {
                    foreach ($rows as $row) {
                        $i++;
                        $this->info('Delete data with content:' . $row->content_id . ' and id:' . $row->id);
                        $this->contentDataService->delete($row->id);
                    }
                }
            );

        $this->info('Total content data deleted: ' . $i);
    }

    public function getOrphansFromContentLikes()
    {
        $i = 0;
        $this->connection->table(config('railcontent.table_prefix') . 'content_likes as content_likes')
            ->select('content_likes.id', 'content_likes.content_id', 'content_likes.user_id')
            ->leftJoin(
                config('railcontent.table_prefix') . 'content as content',
                'content_likes.content_id',
                'content.id'
            )
            ->whereNull('content.id')
            ->orderBy('content_likes.id', 'asc')
            ->chunk(
                10000,
                function (Collection $rows) use (&$i) {
                    foreach ($rows as $row) {
                        $i++;
                        $this->info('Delete content likes for content:' . $row->content_id . ' , id:' . $row->id);
                        $this->contentLikeService->unlike($row->content_id, $row->user_id);
                    }
                }
            );

        $this->info('Total content likes deleted: ' . $i);
    }

    public function getOrphansFromContentPermissions()
    {
        $i = 0;
        $this->connection->table(config('railcontent.table_prefix') . 'content_permissions as content_permissions')
            ->select('content_permissions.id', 'content_permissions.content_id')
            ->leftJoin(
                config('railcontent.table_prefix') . 'content as content',
                'content_permissions.content_id',
                'content.id'
            )
            ->whereNull('content.id')
            ->whereNotNull('content_permissions.content_id')
            ->orderBy('content_permissions.id', 'asc')
            ->chunk(
                10000,
                function (Collection $rows) use (&$i) {
                    foreach ($rows as $row) {
                        $i++;
                        $this->info('Delete content permission for content:' . $row->content_id . ' , id:' . $row->id);
                        $this->contentPermissionService->delete($row->id);
                    }
                }
            );

        $this->info('Total content permissions deleted: ' . $i);
    }

    public function getOrphansFromComments()
    {
        $i = 0;
        $this->connection->table(config('railcontent.table_prefix') . 'comments as comments')
            ->select('comments.id', 'comments.content_id')
            ->leftJoin(
                config('railcontent.table_prefix') . 'content as content',
                'comments.content_id',
                'content.id'
            )
            ->whereNull('content.id')
            ->orderBy('comments.id', 'asc')
            ->chunk(
                10000,
                function (Collection $rows) use (&$i) {
                    foreach ($rows as $row) {
                        $i++;
                        $this->info('Delete comments for content:' . $row->content_id . ' , id:' . $row->id);
                        $this->commentService->delete($row->id);
                    }
                }
            );

        $this->info('Total comments deleted: ' . $i);
    }
}

