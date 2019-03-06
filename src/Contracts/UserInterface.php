<?php

namespace Railroad\Contracts\Contracts;

use Railroad\Doctrine\Contracts\UserEntityInterface;

interface UserInterface extends UserEntityInterface
{
	public function getEmail();
}
