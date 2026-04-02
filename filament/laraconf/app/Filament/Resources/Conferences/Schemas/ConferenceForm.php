<?php

namespace App\Filament\Resources\Conferences\Schemas;

use App\Enums\Region;
use App\Filament\Resources\Speakers\SpeakerResource;
use App\Filament\Resources\Venues\Schemas\VenueForm;
use App\Filament\Resources\Venues\VenueResource;
use App\Models\Conference;
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
            ->components(Conference::getForm());
    }
}
