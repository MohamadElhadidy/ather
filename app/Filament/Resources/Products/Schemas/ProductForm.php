<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Tabs')
                    ->tabs([
                        Tab::make('Info')
                            ->schema([
                                Grid::make(2)->schema([
                                    TextInput::make('name')->live(onBlur: true)
                                        ->required()->afterStateUpdated(fn($set, $state) => $set('slug', Str::slug($state))),
                                    TextInput::make('slug')
                                        ->required()->unique(ignoreRecord: true),
                                ]),

                                Grid::make(2)->schema([
                                    Select::make('category_id')
                                        ->relationship('category', 'name')
                                        ->searchable()
                                        ->preload()
                                        ->required(),
                                    Select::make('brand_id')
                                        ->relationship('brand', 'name')
                                        ->searchable()
                                        ->preload()
                                        ->required(),
                                ]),


                                RichEditor::make('description')
                                    ->columnSpanFull(),
                            ]),
                        Tab::make('Pricing')
                            ->schema([
                                Grid::make(2)->schema([
                                    TextInput::make('price')
                                        ->required()
                                        ->numeric()
                                        ->prefix('$'),

                                    TextInput::make('sale_price')
                                        ->numeric()
                                        ->prefix('$'),
                                    TextInput::make('cost_price')
                                        ->numeric()
                                        ->prefix('$'),
                                ]),


                            ]),
                        Tab::make('Stock')
                            ->schema([

                                TextInput::make('stock')
                                    ->required()
                                    ->numeric()
                                    ->default(0),
                                Grid::make(2)->schema([
                                    Toggle::make('track_stock'),
                                    Toggle::make('show_out_of_stock'),
                                ]),
                            ]),
                        Tab::make('Images')
                            ->schema([
                               Repeater::make('images')
                               ->relationship()
                               ->schema([
                                    FileUpload::make('path')
                                    ->image()
                                    ->directory('products')
                               ])
                               ->orderable('sort_order')
                               ->reorderableWithButtons()
                               ->collapsible()

                            ]),
                    ])->columnSpanFull()


            ]);
    }
}
