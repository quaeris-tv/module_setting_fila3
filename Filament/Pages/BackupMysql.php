<?php

declare(strict_types=1);

namespace Modules\Setting\Filament\Pages;

use Filament\Pages\Page;
use Savannabits\FilamentModules\Concerns\ContextualPage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Webmozart\Assert\Assert;

class BackupMysql extends Page
{
    use ContextualPage;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationGroup = 'Settings';

    protected static string $view = 'setting::filament.pages.backup-mysql';

    public function getViewData(): array
    {
        Assert::isArray($connections = config('database.connections'));

        $connections = array_filter($connections, fn ($item) => 'mysql' === $item['driver']);
        // $connections=collect($connections)->keyBy('database');
        return ['connections' => $connections];
    }

    public function download(string $connectionName): BinaryFileResponse
    {
        return app(\Modules\Setting\Actions\DB\DownloadAction::class)->execute($connectionName);
    }
}
