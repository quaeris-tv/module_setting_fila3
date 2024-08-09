<?php

declare(strict_types=1);

namespace Modules\Setting\Filament\Actions\Table;

use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Gate;
use Modules\Xot\Filament\Traits\NavigationActionLabelTrait;

class DatabaseBackupTableAction extends Action
{
    // use NavigationActionLabelTrait;

    public static function getDefaultName(): ?string
    {
        return 'database-backup';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->translateLabel()
            ->label(trans('setting::database_connection.actions.database-backup.label'))
            ->tooltip(trans('setting::database_connection.actions.database-backup.tooltip'))
            ->icon(trans('setting::database_connection.actions.database-backup.icon'))
            // ->hidden(fn ($record) => Gate::denies('changePriority', $record))
            // ->steps([
            // ])
            ->action(
                function ($record) {
                    dddx([
                        'record' => $record,
                        // 'data' => $data,
                    ]);
                }
            );
    }
}
