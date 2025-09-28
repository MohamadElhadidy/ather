<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('images.path')
                    ->imageHeight(40)
                    ->circular()
                    ->stacked()
                    ->limit(1)
                    ->limitedRemainingText(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('category.name')
                    ->searchable(),
                // TextColumn::make('brand.name')
                //     ->searchable(),
                TextColumn::make('stock')
                    ->numeric()
                    ->sortable(),
                ToggleColumn::make('is_featured'),
                ToggleColumn::make('is_active'),
            ])
            ->filters([
                TrashedFilter::make(),
                SelectFilter::make('is_active')->label('Active')
                    ->options([
                        true => 'Active',
                        false => 'Not Active',
                    ]),
                SelectFilter::make('is_featured')->label('Featured')
                    ->options([
                        true => 'Featured',
                        false => 'Not Featured',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
