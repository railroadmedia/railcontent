<?php

namespace Railroad\Railcontent\Decorators;

abstract class ModeDecoratorBase implements DecoratorInterface
{
    public static $decorationMode = DecoratorInterface::DECORATION_MODE_MAXIMUM;
}