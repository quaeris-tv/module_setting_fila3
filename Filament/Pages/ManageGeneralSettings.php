<?php

declare(strict_types=1);

namespace Modules\Setting\Filament\Pages;


use Filament\Pages\Page;
use Modules\Setting\Settings\GeneralSettings;
use Savannabits\FilamentModules\Concerns\ContextualPage;

class ManageGeneralSettings extends Page
{
    // use ContextualPage;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static ?string $navigationGroup = 'Settings';

    protected static string $settings = GeneralSettings::class;
}
