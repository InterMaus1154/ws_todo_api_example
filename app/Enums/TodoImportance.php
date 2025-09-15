<?php

namespace App\Enums;

enum TodoImportance: int
{
    case Urgent = 1;
    case Mid = 2;
    case Low = 3;
    case None = 0;
}
