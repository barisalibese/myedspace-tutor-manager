<?php

namespace App\Filament\Resources;

use App\Filament\Actions\TutorBulkRateChangeUpdateAction;
use App\Filament\Resources\TutorResource\Pages;
use App\Models\Tutor;
use App\Services\TutorService;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TutorResource extends Resource implements ResourceInterface
{
    protected static ?string $model = Tutor::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    const SUBJECTS = ['Math', 'English', 'Physics', 'Chemistry'];

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                self::getInputComponents()
            );
    }

    public static function table(Table $table): Table
    {
        $tutorService = new TutorService;

        return $table
            ->columns(self::getViewColumns())
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                TutorBulkRateChangeUpdateAction::make('updateHourlyRates'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTutors::route('/'),
            'create' => Pages\CreateTutor::route('/create'),
            'edit' => Pages\EditTutor::route('/{record}/edit'),
        ];
    }

    public static function getInputComponents(): array
    {
        return [
            FileUpload::make('avatar')->disk('public')
                ->directory('uploads/images')
                ->visibility('public')
                ->image()
                ->nullable(),
            TextInput::make('name')->string()->required(),
            TextInput::make('email')->string()->email()->required(),
            TextInput::make('hourly_rate')->numeric()->step(0.01)->required(),
            TagsInput::make('subjects')->suggestions(self::SUBJECTS),
            Textarea::make('bio')->columnSpanFull(),
            Forms\Components\BelongsToManyMultiSelect::make('students')->relationship('students', 'name')->preload()->optionsLimit(5),

        ];
    }

    public static function getViewColumns(): array
    {
        return [
            Tables\Columns\ImageColumn::make('avatar')->disk('public')->visibility('public'),
            TextColumn::make('name'),
            TextColumn::make('email'),
            TextColumn::make('hourly_rate')->numeric(),
            Tables\Columns\TagsColumn::make('subjects'),
        ];
    }
}
