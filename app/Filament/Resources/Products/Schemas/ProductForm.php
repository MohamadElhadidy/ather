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

        $updatedProfitAndMargin = function (callable $set, callable $get) {
            $price = $get('price');
            $cost_price = $get('cost_price');
            if (!empty($price) && !empty($cost_price)) {
                $profit = $price - $cost_price;
                $margin = ($profit / $price) * 100;
                $set('profit', $profit);
                $set('margin', $margin);
            }
        };

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
                                Grid::make(3)->schema([
                                    TextInput::make('price')
                                        ->live(onBlur: true)
                                        ->required()
                                        ->numeric()
                                        ->afterStateUpdated(fn(callable $set, callable $get) => $updatedProfitAndMargin($set, $get))
                                        ->prefix(config('app.currency')),

                                    TextInput::make('compare_at_price')
                                        ->numeric()
                                        ->prefix(config('app.currency')),

                                ]),
                                Grid::make(3)->schema([
                                    TextInput::make('cost_price')
                                        ->live(onBlur: true)
                                        ->numeric()
                                        ->afterStateUpdated(fn(callable $set, callable $get) => $updatedProfitAndMargin($set, $get))
                                        ->prefix(config('app.currency')),
                                    TextInput::make('profit')
                                        ->prefix(config('app.currency'))->disabled()
                                        ->dehydrated(false),
                                    TextInput::make('margin')
                                        ->suffix('%')->disabled()
                                        ->dehydrated(false),
                                ]),


                            ]),
                        Tab::make('Stock')
                            ->schema([

                                Grid::make(3)->schema([
                                    TextInput::make('stock')
                                        ->required()
                                        ->numeric()
                                        ->columnSpan(1)
                                        ->default(0),
                                ]),
                                Grid::make(2)->schema([
                                    Toggle::make('track_stock')->columnSpanFull(),
                                    Toggle::make('show_out_of_stock')->label('Continue selling when out of stock')->columnSpanFull(),
                                ]),
                            ]),
                        Tab::make('Images')
                            ->schema([
                                Repeater::make('images')
                                    ->grid(3)
                                    ->relationship()
                                    ->schema([
                                        FileUpload::make('path')
                                            ->image()
                                            ->previewable()
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
