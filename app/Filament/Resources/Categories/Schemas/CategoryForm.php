<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image')->avatar()->directory('categories'),
                TextInput::make('name')->live(onBlur: true)->afterStateUpdated(fn(callable $set, $state) => $set('slug', Str::slug($state)))->required(),
                TextInput::make('slug')->unique(ignoreRecord: true)->readOnly()->required(),
                RichEditor::make('description')
                    ->columnSpanFull(),
                Select::make('parent_id')
                    ->relationship(name: 'parent', titleAttribute: 'name')->searchable()
                    ->loadingMessage('Loading categories...')
            ]);
    }
}
