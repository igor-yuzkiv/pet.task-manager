<?php

namespace App\Domains\Project\Enums;

enum ProjectStatus: string
{
    case Open = 'open';
    case Active = 'active';
    case InProgress = 'in_progress';
    case Closed = 'closed';
}
