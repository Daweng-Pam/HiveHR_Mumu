<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $label = 'Employee';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Name')->required(),
                TextInput::make('email')->label('Work Email')->required(),
                Select::make('career_role')
                    ->placeholder('Select the role')
                    ->required()
                    ->options([
                        1 => 'Project Manager',
                        2 => 'Business Analyst',
                        3 => 'UI/UX Designer',
                        4 => 'Software Engineer',
                        5 => 'Web Developer',
                        6 => 'Quality Assurance Engineer',
                    ]),
                TextInput::make('eid')->label('EID')->required(),
                TextInput::make('nic')->label('NIC')->required(),
                Forms\Components\Toggle::make('approved')->label('Verified'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('eid')->label('Employee ID')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable()->limit(50),
                Tables\Columns\TextColumn::make('email')->searchable()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('nic')->label('National Identity Card')->searchable()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('approved')->label('Verified')->boolean()->sortable(),
                Tables\Columns\SelectColumn::make('career_role')->options([
                    1 => 'Project Manager',
                    2 => 'Business Analyst',
                    3 => 'UI/UX Designer',
                    4 => 'Software Engineer',
                    5 => 'Web Developer',
                    6 => 'Quality Assurance Engineer'
                ])->sortable()->disabled()->searchable(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ])
            ->where('selected_company', auth()->user()->id);
    }
}
