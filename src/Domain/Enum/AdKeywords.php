<?php

declare(strict_types=1);

namespace App\Domain\Enum;

enum AdKeywords: string
{
    case Bright = 'Luminoso';
    case New = 'Nuevo';
    case Central = 'Céntrico';
    case Renovated = 'Reformado';
    case Penthouse = 'Ático';
    case Flat = 'FLAT';
    case Cottage = 'CHALET';
    case Garage = 'GARAGE';

    public static function toArray(): array
    {
        return [
            self::Bright,
            self::New,
            self::Central,
            self::Renovated,
            self::Penthouse,
            self::Flat,
            self::Cottage,
            self::Garage,
        ];
    }
}

