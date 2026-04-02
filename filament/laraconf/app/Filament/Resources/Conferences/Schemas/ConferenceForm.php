<?php

namespace App\Filament\Resources\Conferences\Schemas;

use App\Enums\Region;
use App\Filament\Resources\Speakers\SpeakerResource;
use App\Filament\Resources\Venues\Schemas\VenueForm;
use App\Filament\Resources\Venues\VenueResource;
use App\Models\Speaker;
use Filament\Forms\Components\CheckboxList;
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
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                    ->searchable()
                    ->preload()
                    // ->editOptionForm()
                    // ->createOptionForm()
                    ->relationship('venue', 'name', modifyQueryUsing: function (Builder $query, Get $get) {
                        return $query->where('region', $get('region'));
                    }),
                CheckboxList::make('speakers')
                    ->relationship('speakers', 'name')
                    ->options(
                        Speaker::all()->pluck('name', 'id')
                    ),
            ]);
    }
}
