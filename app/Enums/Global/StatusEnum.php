<?php

namespace App\Enums\Global;

use BenSampo\Enum\Enum;

final class StatusEnum extends Enum
{
    public const Pending    = 0;
    public const Processing = 1;
    public const Error      = 2;
    public const Success    = 3;
}
