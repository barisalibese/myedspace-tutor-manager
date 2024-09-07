<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StudentResource extends Resource implements ResourceInterface
{
    protected static ?string $model = Student::class;

    public static array $gradeLevelOptions = [
        1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12,
    ];

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                self::getInputComponents()
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(self::getViewColumns())
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\CreateAction::make('create'),
                Tables\Actions\EditAction::make('edit'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make('delete'),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }

    public static function getInputComponents(): array
    {
        return [
            TextInput::make('name'),
            TextInput::make('email'),
            Select::make('grade_level')->options(self::$gradeLevelOptions),
            Forms\Components\BelongsToManyMultiSelect::make('tutors')->relationship('tutors', 'name')->preload()->optionsLimit(5),
        ];
    }

    public static function getViewColumns(): array
    {
        return [
            TextColumn::make('name'),
            TextColumn::make('email'),
            Tables\Columns\SelectColumn::make('grade_level')->options(self::$gradeLevelOptions),
        ];
    }
}
