<?php

namespace Railroad\Railcontent\DataFixtures;

use Carbon\Carbon;
use Railroad\Railcontent\Entities\Permission;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Railroad\Railcontent\Services\ConfigService;

class PermissionFixtureLoader implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $permission = new Permission();
        $permission->setBrand(ConfigService::$brand);
        $permission->setName('permission 1');
//        $emailChange->setEmail('test_change@test.com');
//        $emailChange->setToken('token1');
//        $emailChange->setUser($user);
//        $emailChange->setCreatedAt(Carbon::now());
//
//        $manager->persist($emailChange);
//
//        $user2 =
//            $manager->getRepository(User::class)
//                ->find(2);
//
//        $emailChange2 = new EmailChange();
//        $emailChange2->setEmail('test_change2@test.com');
//        $emailChange2->setToken('token2');
//        $emailChange2->setUser($user2);
//        $emailChange2->setCreatedAt(Carbon::now()->subYear(1));

        $manager->persist($permission);

        $manager->flush();
        $manager->clear();
    }
}