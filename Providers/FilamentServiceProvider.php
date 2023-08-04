<?php

namespace Modules\Setting\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;
use Savannabits\FilamentModules\FilamentModules;
use Savannabits\FilamentModules\ContextServiceProvider;
use Modules\Xot\Providers\XotBaseContextServiceProvider;

class FilamentServiceProvider extends XotBaseContextServiceProvider
{
    public static string $name = 'setting-filament';
    public static string $module = 'Setting';
    /*
    public function packageRegistered(): void
    {
        $this->app->booting(function () {
            $this->registerConfigs();
        });
        parent::packageRegistered();
    }

    public function registerConfigs() {
        $this->mergeConfigFrom(
            app('modules')->findOrFail(static::$module)->getExtraPath( 'Config/'.static::$name.'.php'),
            static::$name
        );
    }

    public function boot()
    {
        parent::boot();
        app(FilamentModules::class)->prepareDefaultNavigation(static::$module, static::$name);
    }
    */
}
