<?php

namespace Modules\Setting\Filament\Pages;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;
use Modules\Setting\Settings\GeneralSettings;
use Savannabits\FilamentModules\Concerns\ContextualPage;

class ManageGeneralSettings extends SettingsPage
{
    use ContextualPage;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationGroup = 'Settings';

    protected static string $settings = GeneralSettings::class;

    protected function getFormSchema(): array
    {
        //\Log::info(varDump(-1, ' -1 app/Filament/Pages/ManageAppSettings.php::'));
        return [
            TextInput::make('site_name')
                ->label('Site name')
                ->required(),
            /*
            SpatieMediaLibraryFileUpload::make('logo')
                ->responsiveImages(),
            */
            //*
            FileUpload::make('logo')
                ->preserveFilenames()
            //->imageEditor()
            ,
            //*/
            //...
        ];
    }
}
