<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Task;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\TaskResource\Pages;
use App\Filament\Resources\TaskResource\RelationManagers;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->columnSpan($span = 1)
                    ->autofocus()->required()->placeholder('What do you need to do?'),
                Forms\Components\Select::make('priority')
                    ->placeholder('How important is this task?')
                    ->options([
                        'Low' => 'Low',
                        'Medium' => 'Medium',
                        'High' => 'High',
                    ])
                    ->required(),
                Forms\Components\RichEditor::make('description')
                    ->autofocus() // Autofocus the field.
                    ->columnSpan($span = 2)
                    ->disableToolbarButtons($buttons = [
                        'attachFiles',
                        'heading',
                        'subheading'
                    ])
                    ->placeholder('Describe the task in detail.'),
                Forms\Components\DatePicker::make('due_date')
                    ->autofocus()
                    ->displayFormat($format = 'l, j M Y')
                    ->firstDayOfWeek($day = 1)
                    ->minDate(now())
                    ->placeholder('When is the deadline?')
                    ->weekStartsOnMonday()
                    ->weekStartsOnSunday(),
                Forms\Components\TimePicker::make('due_time')
                    ->autofocus()
                    ->displayFormat($format = 'H:i')
                    ->placeholder('When is the deadline?')
                    ->weekStartsOnMonday()
                    ->weekStartsOnSunday()
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('No'),
                TextColumn::make('title'),
                TextColumn::make('due_time')->time('H:i'),
                TextColumn::make('due_date')->date('l, j M Y'),
                BadgeColumn::make('priority')
                ->sortable()
                    ->colors([
                        'warning' => static fn ($state): bool => $state === 'Medium',
                        'success' => static fn ($state): bool => $state === 'Low',
                        'danger' => static fn ($state): bool => $state === 'High',
                    ])
            ])
            ->filters([
                SelectFilter::make('priority')
                    ->options([
                        'Low' => 'Low',
                        'Medium' => 'Medium',
                        'High' => 'High',
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\CategoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
