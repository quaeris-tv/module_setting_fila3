<?php

declare(strict_types=1);

namespace Modules\Setting\Filament\Pages;


use Filament\Pages\Page;
use Modules\Setting\Settings\GeneralSettings;


class ManageGeneralSettings extends Page
{
    //

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static ?string $navigationGroup = 'Settings';

    protected static string $settings = GeneralSettings::class;

    // public function mount(): void {
    //     $user = auth()->user();
    //     if(!$user->hasRole('super-admin')){
    //         redirect('/admin');
    //     }
    // }
}
