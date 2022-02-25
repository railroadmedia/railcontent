<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers\NewStructure;

use Carbon\Carbon;
use Doctrine\DBAL\Logging\DebugStack;
use Elastica\Mapping;
use Elastica\Processor\Sort;
use Elastica\Query;
use Elastica\Query\Match;
use Elastica\Query\Script as ScriptQuery;
use Elastica\Query\Term;
use Elastica\QueryBuilder;
use Elastica\Script\Script;
use JMS\Serializer\Tests\Fixtures\Discriminator\Car;
use Railroad\Railcontent\Contracts\UserProviderInterface;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\UserContentProgress;
use Railroad\Railcontent\Managers\SearchEntityManager;
use Railroad\Railcontent\Managers\RailcontentEntityManager;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\ElasticService;
use Railroad\Railcontent\Services\FullTextSearchService;
use Railroad\Railcontent\Services\ResponseService;
use Railroad\Railcontent\Tests\RailcontentTestCase;
use Response;

class ElasticTest extends RailcontentTestCase
{
    /**
     * @var ContentService
     */
    protected $serviceBeingTested;

    protected $railcontentEntityManager;

    protected $userProviderInterface;

    protected $contentService;

    protected $fullTextService;

    protected function setUp()
    {
        parent::setUp();

        $this->serviceBeingTested = $this->app->make(ElasticService::class);

        $this->contentService = $this->app->make(ContentService::class);

        $this->fullTextService = $this->app->make(FullTextSearchService::class);

        $this->railcontentEntityManager = $this->app->make(RailcontentEntityManager::class);

        $this->userProviderInterface = $this->app->make(UserProviderInterface::class);

        ResponseService::$oldResponseStructure = false;
    }

    public function test_elastic()
    {
        for ($i = 0; $i < 5; $i++) {
            $content = new Content();
            $content->setTitle('Test content s - ' . $i);
            $content->setSlug($this->faker->slug());
            $content->setLanguage($this->faker->word);
            $content->setDifficulty($i);
            $content->setType($this->faker->randomElement(['course', 'song', 'play-along']));
            $content->setBrand(config('railcontent.brand'));
            $content->setCreatedOn(
                Carbon::now()
                    ->subWeek(3)
            );
            $content->setPublishedOn(
                Carbon::now()
                    ->subDays($i)
            );
            $content->setStatus($this->faker->randomElement(['published']));

            $this->railcontentEntityManager->persist($content);
            $this->railcontentEntityManager->flush();

            if ($i % 2 == 0) {
                for ($j = 0; $j <= $i; $j++) {
                    $userId = $this->createAndLogInNewUser();
                    $user = $this->userProviderInterface->getRailcontentUserById($userId);
                    $userProgress = new UserContentProgress();
                    $userProgress->setUser($user);
                    $userProgress->setContent($content);
                    $userProgress->setProgressPercent(rand(1, 99));
                    $userProgress->setState('started');

                    $userProgress->setUpdatedOn(Carbon::now());

                    $this->railcontentEntityManager->persist($userProgress);
                    $this->railcontentEntityManager->flush();
                }
            }

        }

        $results = $this->contentService->getFiltered(
            1,
            100,
            'popularity',
            ['song','course'],
            [],
            [],
            [
                'difficulty,3' ,
                //,
               // 'topics' => 'jazz',
               // 'topics' => 'Jazz',
               // 'artist' => 'Miles Davis',
              // 'topics' => 'Flams'
            ],
            [],
            [],
            ['started','completed'],
            true,
            false,
            true,[]
        //    ['102294']
        //['149253']

        );

        foreach ($results->results() as $result) {
$this->assertTrue($result->getDifficulty() == 3);

        }
    }

    public function _test_search()
    {
//        dd($this->fullTextService->search('mascia'));
    }
}
