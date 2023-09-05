<?php

declare(strict_types=1);

namespace Modules\Setting\Filament\Pages;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;
use Modules\Setting\Settings\GeneralSettings;
use Savannabits\FilamentModules\Concerns\ContextualPage;

final class ManageGeneralSettings extends SettingsPage
{
    //use ContextualPage;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    
    protected static ?string $navigationGroup = 'Settings';

    protected static string $settings = GeneralSettings::class;
}
