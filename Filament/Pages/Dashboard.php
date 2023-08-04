<?php

namespace Modules\Setting\Filament\Pages;

use Filament\Pages\Page;
use Savannabits\FilamentModules\Concerns\ContextualPage;

class Dashboard extends Page
{
    use ContextualPage;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'setting::filament.pages.dashboard';

    public function getViewData(): array
    {

        return ['a'=>'b'];
    }
}
