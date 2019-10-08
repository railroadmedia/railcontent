<?php

namespace Railroad\Railcontent\Tests\Fixtures;

use Faker\Generator;
use Railroad\Railcontent\Contracts\UserInterface;
use Railroad\Railcontent\Factories\Factory;

class User implements UserInterface
{
    protected $id;
    protected $email;
    protected $displayName;
    protected $avatar;

    public function __construct(int $id, string $email = null, string $displayName = null, string $avatar = null)
    {
        $this->id = $id;
        $faker = app()->make(Generator::class);
        if (func_num_args() < 2) {

            $this->email = $faker->email;
        } else {
            $this->email = $email;
        }

        $this->displayName = ($displayName) ? $displayName : $faker->name;
        $this->avatar = ($avatar)? $avatar:$faker->url;
    }

    public function getId()
    : int
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function __toString()
    {
        /*
        method needed by UnitOfWork
        https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/cookbook/custom-mapping-types.html
        */

        return (string)$this->id;
    }
}
