<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Decorators\DecoratorInterface;

abstract class ModeDecoratorBase implements DecoratorInterface
{
    public static $decorationMode = DecoratorInterface::DECORATION_MODE_MAXIMUM;
}
