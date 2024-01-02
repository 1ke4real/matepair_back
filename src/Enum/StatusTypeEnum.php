<?php
namespace App\Enum;

enum StatusTypeEnum: string
{
    case WAITING = 'waiting';
    case ACCEPTED = 'accepted';
    case REFUSED = 'refused';
}
