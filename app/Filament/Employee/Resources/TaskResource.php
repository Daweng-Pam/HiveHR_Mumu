<?php

namespace App\Filament\Employee\Resources;

use App\Filament\Employee\Resources\TaskResource\Pages;
use App\Filament\Employee\Resources\TaskResource\RelationManagers;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Task Details')
                    ->schema([
                        Forms\Components\TextInput::make('title')->disabled()
                            ->label('Title')->required()->columnSpanFull(),
                        Forms\Components\RichEditor::make('description')->label('Description')->required()->columnSpanFull()->disabled(),
                        ToggleButtons::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'ongoing' => 'Ongoing',
                                'completed' => 'Completed'
                            ])
                            ->icons([
                                'pending' => 'heroicon-o-clock',
                                'ongoing' => 'heroicon-o-pencil',
                                'completed' => 'heroicon-o-check-circle',
                            ])
                            ->colors([
                                'pending' => 'danger',
                                'ongoing' => 'warning',
                                'completed' => 'success',
                            ])
                            ->grouped()
                            ->inline()
                            ->columnSpanFull()
                            ->required(),


                        Forms\Components\Select::make('assigned_employee')
                            ->label('Assigned Member')
//                            ->searchable()
                            ->hidden()
                            ->relationship('assignedEmployee', 'name')
                            ->options(User::where('role', '=', 2)->where('approved', '=', 1)->where('career_role', '!=', 1)->where('selected_company', '=', auth()->user()->id)->get()->pluck('name', 'id')->toArray())
                            ->required(),


                        Forms\Components\Select::make('project_id')
                            ->label('Project')
//                            ->searchable()
                            ->hidden()
                            ->relationship('project', 'title')
                            ->options(Project::where('company_id', '=', auth()->user()->id)->get()->pluck('title', 'id')->toArray())
                            ->required(),
//                        Forms\Components\Select::make('project_manager')
//                            ->label('Project Manager')
//                            ->relationship('users', 'name')
//                            ->required()
//                            ->columnSpanFull(),
//                        Forms\Components\Select::make('company_id')
//                            ->label('Company')
//                            ->relationship('companies', 'name')
//                            ->required()
//                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Title')->searchable()->sortable()->limit(30),
                Tables\Columns\TextColumn::make('description')->label('Description')->searchable()->sortable()->markdown()->limit(30),
                Tables\Columns\TextColumn::make('project.title')->label('Project')->searchable()->sortable()->limit(30),
                Tables\Columns\TextColumn::make('assignedEmployee.name')->label('Assigned Member')->searchable()->sortable()->badge(),
                IconColumn::make('status')->sortable()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'danger',
                        'ongoing' => 'warning',
                        'completed' => 'success',
                    })
                    ->icon(fn(string $state): string => match ($state) {
                        'pending' => 'heroicon-o-clock',
                        'ongoing' => 'heroicon-o-pencil',
                        'completed' => 'heroicon-o-check-circle',
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('assigned_employee', auth()->user()->id);
    }
}
