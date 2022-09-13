<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class PublishType extends Enum implements LocalizedEnum
{
    const PUBLISHED =   'published';
    const DRAFT =   'draft';
}
