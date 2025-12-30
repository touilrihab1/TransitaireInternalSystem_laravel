<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Filament\Resources\UserResource\RelationManagers\RolesRelationManager;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'utilisateurs';

    // protected static ?string $slug = 'manage/users';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\DateTimePicker::make('email_verified_at'),
                    Forms\Components\TextInput::make('password')
                        ->password()
                        ->dehydrateStateUsing(static fn (null|string $state):
                            null|string =>
                            filled($state) ? Hash::make($state) : null,
                        )
                        ->required(static fn (Page $livewire): bool =>
                            $livewire instanceof CreateUser,
                        )
                        ->dehydrated(static fn (null|string $state): bool =>
                            filled($state),
                        )->label(static fn (Page $livewire): string =>
                            ($livewire instanceof EditUser) ? 'Nouveau Mot de pass' : 'Mot de pass'
                        )
                        ->maxLength(255),
                    // Forms\Components\TextInput::make('role')
                    //     ->required(),
                    Forms\Components\Select::make('roles')
                        ->multiple()
                        ->relationship('roles', 'name')->preload()
                        ->createOptionForm([
                            Forms\Components\TextInput::make('name')
                                ->required(),

                            Forms\Components\TextInput::make('guard_name')
                                ->required()
                                ->maxLength(255)
                                ->default("web")
                                ->hidden(true)
                        ])->columnSpan(['sm' => 2, 'md' => 2, 'lg' => 3]),
                    Forms\Components\Select::make('permissions')
                        ->multiple()
                        ->relationship('permissions', 'name')->preload()
                        ->createOptionForm([
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('guard_name')
                                ->required()
                                ->maxLength(255)
                                ->default("web")
                                ->hidden(true)
                        ])->columnSpan(['sm' => 2, 'md' => 2, 'lg' => 3]),
                ])->columns(['md' => 2, 'lg' => 3, 'xl' => 4 ,'2xl' => 5])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\IconColumn::make('test')->boolean()->default(false),
                Tables\Columns\TextColumn::make('roles.name'),
                Tables\Columns\TextColumn::make('email'),
                // Tables\Columns\TextColumn::make('email_verified_at')
                //     ->dateTime(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('role'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // RolesRelationManager::class,
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
}
