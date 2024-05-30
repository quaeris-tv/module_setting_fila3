<?php

namespace Modules\Setting\Filament\Resources\DatabaseConnectionResource\Pages;

use Modules\Setting\Filament\Resources\DatabaseConnectionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDatabaseConnection extends CreateRecord
{
    protected static string $resource = DatabaseConnectionResource::class;
}
