<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class ItemType extends Enum implements LocalizedEnum
{
    const NORMAL        =   'normal';
    const USER_SUPPORT   =   'user_support';
    const YOSAKOI   =   'yosakoi';
}
