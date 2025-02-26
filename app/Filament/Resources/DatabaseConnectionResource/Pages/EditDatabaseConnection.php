<?php

declare(strict_types=1);

namespace Modules\Setting\Filament\Resources\DatabaseConnectionResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Setting\Filament\Resources\DatabaseConnectionResource;

class EditDatabaseConnection extends EditRecord
{
    protected static string $resource = DatabaseConnectionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('test')
                ->action(fn () => $this->record->testConnection())
                ->icon('heroicon-o-check-circle')
                ->color('success'),
        ];
    }

    protected function afterSave(): void
    {
        if ('active' === $this->record->status) {
            $this->record->testConnection();
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
