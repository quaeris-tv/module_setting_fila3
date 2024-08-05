<?php

declare(strict_types=1);

namespace Modules\Setting\Filament\Resources\DatabaseConnectionResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\Setting\Filament\Actions\Table\DatabaseBackupTableAction;
use Modules\Setting\Filament\Resources\DatabaseConnectionResource;
use Modules\UI\Enums\TableLayoutEnum;
use Modules\UI\Filament\Actions\Table\TableLayoutToggleTableAction;
use Modules\Xot\Filament\Traits\NavigationPageLabelTrait;

class ListDatabaseConnections extends ListRecords
{
    use NavigationPageLabelTrait;

    protected static string $resource = DatabaseConnectionResource::class;

    public TableLayoutEnum $layoutView = TableLayoutEnum::GRID;

    {
        return [
            TableLayoutToggleTableAction::make(),
        ];
    }

    protected function getHeaderActions(): array
            // Actions\CreateAction::make(),
        ];
    }

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
}
