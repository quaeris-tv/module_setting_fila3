<?php

namespace Modules\Setting\Filament\Pages;

use Filament\Pages\SettingsPage;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Modules\Setting\Settings\GeneralSettings;
use Savannabits\FilamentModules\Concerns\ContextualPage;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Pages\Page;

class BackupMysql extends Page
{
    use ContextualPage;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationGroup = 'Settings';

    protected static string $view = 'setting::filament.pages.backup-mysql';

    public function getViewData(): array
    {
        $connections=config('database.connections');
        $connections=array_filter($connections,fn($item)=>$item['driver']=='mysql');
        //$connections=collect($connections)->keyBy('database');
        return ['connections'=>$connections];
    }

    public function download(string $connectionName){
        return app(\Modules\Setting\Actions\DB\DownloadAction::class)->execute($connectionName);
    }

}