<?php

namespace App\Enum;

enum ArticleType: string
{
    case NORMAL = 'normal';
    case COURSE = 'course';

    public static function getTypes(): array
    {
        return [
            self::NORMAL->value,
            self::COURSE->value,
        ];
    }
}
