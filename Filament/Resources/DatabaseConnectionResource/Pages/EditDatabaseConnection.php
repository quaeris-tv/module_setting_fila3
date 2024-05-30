<?php

namespace Modules\Setting\Filament\Resources\DatabaseConnectionResource\Pages;

use Modules\Setting\Filament\Resources\DatabaseConnectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDatabaseConnection extends EditRecord
{
    protected static string $resource = DatabaseConnectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
