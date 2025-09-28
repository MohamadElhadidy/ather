<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->circular(),
                TextColumn::make('name')->searchable()->sortable(),

                TextColumn::make('description')
                    ->placeholder('No description')
                    ->html()
                    ->searchable()
                    ->formatStateUsing(fn($state) => str($state)->words(4)),
                TextColumn::make('parent.name')->searchable()->sortable(),

                ToggleColumn::make('is_active'),
            ])
            ->filters([
                TrashedFilter::make(),
                Filter::make('is_active')
                    ->query(fn(Builder $query): Builder => $query->where('is_active', true)),
                SelectFilter::make('is_active')->label('Active')
                    ->options([
                        true => 'Active',
                        false => 'Not Active',
                    ])
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
