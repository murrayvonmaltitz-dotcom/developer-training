<?php

namespace App\Filament\Resources\Conferences\Schemas;

use App\Enums\Region;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\Markdown;
use Illuminate\Database\Eloquent\Builder;

class ConferenceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Conference')
                    ->default("My Conference")
                    ->helperText('The name of the conference.')
                    ->maxLength(60)
                    ->required(),
                MarkdownEditor::make('description')
                    ->helperText("hello")
                    ->required(),
                DatePicker::make('start_date')
                    ->native(false)
                    ->required(),
                DateTimePicker::make('end_date')
                    ->native(false)
                    ->required(),
                Toggle::make("is_published")
                    ->default(false),
                Select::make('status')
                ->options([
                    'draft' => 'Draft',
                    'Published' => 'Published',
                    'archived' => 'Archived'
                    ]),
                Select::make('region')
                    ->live()
                    ->enum(Region::class)
                    ->options(Region::class),
                Select::make('venue_id')
                    ->relationship('venue', 'name', modifyQueryUsing: function (Builder $query, Get $get) {
                        return $query->where('region', $get('region'));
                    }),
            ]);
    }
}
