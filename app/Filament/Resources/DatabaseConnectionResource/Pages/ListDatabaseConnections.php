<?php

declare(strict_types=1);

namespace Modules\Setting\Filament\Resources\DatabaseConnectionResource\Pages;

use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\Setting\Filament\Actions\Table\DatabaseBackupTableAction;
use Modules\Setting\Filament\Resources\DatabaseConnectionResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListDatabaseConnections extends XotBaseListRecords
{
    protected static string $resource = DatabaseConnectionResource::class;

    public function getListTableColumns(): array
    {
        return [
            'name' => TextColumn::make('name')
                ->searchable()
                ->sortable(),

            'driver' => TextColumn::make('driver')
                ->searchable(),

            'host' => TextColumn::make('host')
                ->searchable(),

            'port' => TextColumn::make('port')
                ->numeric()
                ->sortable(),

            'database' => TextColumn::make('database')
                ->searchable(),

            'username' => TextColumn::make('username')
                ->searchable(),

            'status' => BadgeColumn::make('status')
                ->colors([
                    'danger' => 'inactive',
                    'warning' => 'testing',
                    'success' => 'active',
                ]),
        ];
    }

    public function getTableFilters(): array
    {
        return [
        ];
    }

    public function getTableActions(): array
    {
        return [
            DatabaseBackupTableAction::make(),
        ];
    }

    public function getTableBulkActions(): array
    {
        return [
            Tables\Actions\DeleteBulkAction::make(),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns($this->getListTableColumns())
            ->filters($this->getTableFilters())
            ->actions($this->getTableActions())
            ->bulkActions($this->getTableBulkActions());
    }
}
