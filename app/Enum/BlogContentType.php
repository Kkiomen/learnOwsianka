<?php

namespace App\Enum;

enum BlogContentType: string
{
    case TEXT = 'text';
    case IMAGE = 'image';
    case TEXT_WITH_HEADER = 'text_with_header';
}
