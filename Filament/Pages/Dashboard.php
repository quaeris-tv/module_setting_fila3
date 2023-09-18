<?php

declare(strict_types=1);

namespace Modules\Setting\Filament\Pages;

use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'setting::filament.pages.dashboard';

    protected function getViewData(): array
    {
        return ['a' => 'b'];
    }

    public function mount(): void {
        $user = auth()->user();
        if(!$user->hasRole('super-admin')){
            redirect('/admin');
        }
    }
}
