<?php

declare(strict_types=1);

namespace Modules\Setting\Settings;

use Illuminate\Support\Facades\Storage;
use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    /* implements HasMedia */
    // use InteractsWithMedia;
    public string $site_name;

    public bool $site_active;

    public string $logo;

    public static function group(): string
    {
        return 'general';
    }

    public function getLogoUrl(): string
    {
        return Storage::disk('public')->url($this->logo);
    }
}
