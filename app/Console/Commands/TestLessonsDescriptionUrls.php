<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Railroad\MusoraApi\Decorators\DateFormatDecorator;
use Railroad\MusoraApi\Decorators\LiveEventDecorator;
use Railroad\MusoraApi\Decorators\MobileAppUrlDecorator;
use Railroad\MusoraApi\Decorators\OldPlatformLinksDecorator;
use Railroad\MusoraApi\Decorators\StripTagDecorator;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;

class TestLessonsDescriptionUrls extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'TestLessonsDescriptionUrls';

    protected $signature = 'TestLessonsDescriptionUrls';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'TestLessonsDescriptionUrls';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(
        DatabaseManager $databaseManager,
        ContentService $contentService,
        OldPlatformLinksDecorator $oldPlatformLinksDecorator
    ): int {
        ContentRepository::$bypassPermissions = true;
        //        $allDecoratorsForContent = [
        //            OldPlatformLinksDecorator::class
        //
        //        ];
        //
        //
        //        ConfigService::$decorators['content'] = $allDecoratorsForContent;

        $this->info('Starting TestLessonsDescriptionUrls.');
        Log::info('Starting TestLessonsDescriptionUrls.');

        $connection = $databaseManager->connection(config('railcontent.database_connection_name'));

        $contentRows =
            $connection->table('railcontent_content')
                ->join('railcontent_content_data', 'railcontent_content_data.content_id', '=', 'railcontent_content.id')
                ->where('railcontent_content_data.key', '=', 'description')
                ->where('railcontent_content_data.value', 'like', '%www.guitareo.com%')
                ->where('brand', 'guitareo')
                ->get();
        //
        //        $contentRows =
        //                        $connection->table('railcontent_content')
        //                            ->join('railcontent_comments', 'railcontent_comments.content_id', '=', 'railcontent_content.id')
        //                            ->where('railcontent_comments.comment', 'like', '%www.drumeo.com%')
        //                            ->where('railcontent_content.brand', 'drumeo')
        //                            ->get();
        config()->set('railcontent.brand', 'guitareo');

        foreach ($contentRows as $row) {
            $this->info($row->id.' ----------------  '.$row->value);
            $content = $contentService->getByIds([$row->content_id]);
            $decorator = new OldPlatformLinksDecorator($contentService);
            $decorator->decorate($content);
        }

        $this->info('---------------------------------------------------');
        $this->info('Finished TestLessonsDescriptionUrls!');
        Log::info('Finished TestLessonsDescriptionUrls!');

        return true;
    }
}
