<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Elastica\Client;
use Railroad\Railcontent\Contracts\UserProviderInterface;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\UserPermission;
use Railroad\Railcontent\Entities\UserPlaylist;
use Railroad\Railcontent\Entities\UserPlaylistContent;
use Railroad\Railcontent\Hydrators\CustomRailcontentHydrator;
use Railroad\Railcontent\Managers\RailcontentEntityManager;
use Railroad\Railcontent\Managers\SearchEntityManager;
use Railroad\Railcontent\Repositories\UserPlaylistRepository;

class ElasticService
{
    /**
     * @var RailcontentEntityManager
     */
    private $entityManager;

    /**
     * @var ObjectRepository|EntityRepository
     */
    private $userPlaylistRepository;

    /**
     * @var ObjectRepository|EntityRepository
     */
    private $contentUserPlaylistRepository;

    /**
     * @var ObjectRepository|EntityRepository
     */
    private $contentRepository;

    /**
     * @var UserProviderInterface
     */
    private $userProvider;

    /**
     * @var CustomRailcontentHydrator
     */
    private $resultsHydrator;

    /**
     * UserPlaylistService constructor.
     *
     * @param RailcontentEntityManager $entityManager
     * @param UserProviderInterface $userProvider
     */
    public function __construct(
    ) {

    }

    /**
     * @return Client
     */
   public function getClient()
   {
       $config = [
           'host' => 'elasticsearch',
           'username' => 'elastic',
           'password' => 'changeme',
       ];
       $client = new Client($config);

       return $client;
   }

   public function setMapping($index)
   {
       // Define mapping
       $mapping = new \Elastica\Mapping();
   
       // Set mapping
       $mapping->setProperties(array(
           'id'      => array('type' => 'integer'),
           'title'     => array('type' => 'text'),
           'slug'     => array('type' => 'text'),
           'brand'     => array('type' => 'text'),
           'content_type' => array('type' => 'text'),
           'status'     => array('type' => 'text'),
           'difficulty'     => array('type' => 'text'),
//           'published_on'  => array('type' => 'date'),
            'style'=> array('type' => 'text')
       ));

       // Send mapping to type
       $mapping->send($index);
   }
}
