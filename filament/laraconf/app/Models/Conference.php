<?php

namespace App\Models;

use App\Enums\Region;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use PHPUnit\Logging\OpenTestReporting\Status;

class Conference extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'start_date' => 'datetime',
            'end_date' => 'datetime',
            'venue_id' => 'integer',
            'region' => Region::class,
        ];
    }

    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }

    public function speakers(): BelongsToMany
    {
        return $this->belongsToMany(Speaker::class);
    }

    public function talks(): BelongsToMany
    {
        return $this->belongsToMany(Talk::class);
    }

    public static function getForm() {
        return [
            Section::make('Conference Details')
                ->description('Provide some basic info about conferences')
                ->collapsible()
                ->columnSpanFull()
                ->columns(2)
                ->schema([ 
                    TextInput::make('name')
                        ->columnSpanFull()
                        ->label('Conference')
                        ->default("My Conference")
                        ->maxLength(60)
                        ->required(),
                    MarkdownEditor::make('description')
                        ->columnSpanFull()
                        ->required(),
                    DateTimePicker::make('start_date')
                        ->native(false)
                        ->required(),
                    DateTimePicker::make('end_date')
                        ->native(false)
                        ->required(),
                    Fieldset::make('Status')
                        ->columnSpanFull()
                        ->columns(2)
                        ->schema([
                        Toggle::make("is_published")
                            ->default(false),
                        Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Published',
                                'archived' => 'Archived'
                            ])
                        ])
                ]),
            Section::make('Location')
                ->columnSpanFull()
                ->schema([
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
                    ]),
                        
            ];
    }
}
