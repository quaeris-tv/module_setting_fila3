<?php

declare(strict_types=1);

namespace Modules\Setting\Filament\Resources\DatabaseConnectionResource\Pages;

use Filament\Tables;
use Filament\Tables\Table;
use Modules\UI\Enums\TableLayoutEnum;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Pages\ListRecords;
use Modules\Xot\Filament\Pages\XotBaseListRecords;
use Modules\Xot\Filament\Traits\NavigationPageLabelTrait;
use Modules\Setting\Filament\Resources\DatabaseConnectionResource;
use Modules\UI\Filament\Actions\Table\TableLayoutToggleTableAction;
use Modules\Setting\Filament\Actions\Table\DatabaseBackupTableAction;

class ListDatabaseConnections extends XotBaseListRecords
{

    protected static string $resource = DatabaseConnectionResource::class;

    public function getTableColumns(): array
    {
        return [
            TextColumn::make('name')->searchable()->sortable(),
            TextColumn::make('driver')->searchable()->sortable(),
            TextColumn::make('database')->searchable()->sortable(),
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
            // Tables\Actions\EditAction::make(),
            DatabaseBackupTableAction::make(),
        ];
    }

    public function getTableBulkActions(): array
    {
        return [
            // Tables\Actions\BulkActionGroup::make([
            Tables\Actions\DeleteBulkAction::make(),
            // ]),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns($this->getTableColumns())
            ->filters($this->getTableFilters())
            ->actions($this->getTableActions())
            ->bulkActions($this->getTableBulkActions());
    }

    protected function getTableHeaderActions(): array
    {
        return [
            TableLayoutToggleTableAction::make(),
        ];
    }
}
