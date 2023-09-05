<?php

declare(strict_types=1);

namespace Modules\Setting\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

final class Setting extends BaseModel implements HasMedia
{
    use InteractsWithMedia;
}
