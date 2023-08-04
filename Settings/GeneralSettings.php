<?php

namespace Modules\Setting\Settings;

use Spatie\MediaLibrary\HasMedia;
use Spatie\LaravelSettings\Settings;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\InteractsWithMedia;

class GeneralSettings extends Settings /*implements HasMedia */
{
    //use InteractsWithMedia;
    public string $site_name;

    public bool $site_active;

    public string $logo;

    public static function group(): string
    {
        return 'general';
    }

    public function getLogoUrl(): string
    {
        $logo_url=Storage::disk('public')->url($this->logo);
        return $logo_url;
    }
}
