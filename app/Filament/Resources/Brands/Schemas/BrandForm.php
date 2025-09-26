<?php

namespace App\Filament\Resources\Brands\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BrandForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image')->image()->columnSpan(2),
                TextInput::make('name')->live()->afterStateUpdated(fn(callable $set, $state)=> $set('slug', Str::slug($state)))->required(),
                TextInput::make('slug')->unique(ignoreRecord: true)->readOnly()->required(),
                RichEditor::make('description')->columnSpan(2),
            ]);
    }
}
