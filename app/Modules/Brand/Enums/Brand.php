<?php

namespace App\Modules\Brand\Enums;

use Illuminate\Support\Arr;

enum Brand: string
{
    case Drumeo = 'drumeo';
    case Pianote = 'pianote';
    case Guitareo = 'guitareo';
    case Singeo = 'singeo';
    case Musora = 'musora';

    public static function values(): array
    {
        return Arr::map(self::cases(), fn ($t) => $t->value);
    }
}
