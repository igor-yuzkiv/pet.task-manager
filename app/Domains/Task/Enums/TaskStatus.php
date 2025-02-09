<?php

namespace App\Domains\Task\Enums;

enum TaskStatus: string
{
    case Open = 'open';

    case InProgress = 'in_progress';

    case ReadyToTest = 'ready_to_test';

    case Closed = 'closed';
}
