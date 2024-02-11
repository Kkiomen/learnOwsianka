<?php

namespace App\Api\MyVpsApplication\Dto;

enum ChatGptCollectionRequestModelDto: string
{
    case GPT_3 = 'gpt-3';
    case GPT_4 = 'gpt-4';
}
