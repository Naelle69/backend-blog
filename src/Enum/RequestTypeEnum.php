<?php

namespace App\Enum;

enum RequestTypeEnum: string
{
    case COACHING = 'coaching';
    case COLLABORATION = 'collaboration';
    case PARTNERSHIP = 'partnership';
    case OTHER = 'other';
}