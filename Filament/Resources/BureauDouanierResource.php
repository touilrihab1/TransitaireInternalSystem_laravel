<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BureauDouanierResource\Pages;
use App\Filament\Resources\BureauDouanierResource\RelationManagers;
use App\Models\BureauDouanier;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BureauDouanierResource extends Resource
{
    protected static ?string $model = BureauDouanier::class;

    protected static ?string $navigationGroup = 'Bureaus';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // TextInput::make('code')
                //     ->numeric()
                //     ->required()
                //     ,
                TextInput::make('bureau_d')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('bureau_d'),
                TextColumn::make('created_at')
                    ->dateTime(),
                TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBureauDouaniers::route('/'),
            'create' => Pages\CreateBureauDouanier::route('/create'),
            'edit' => Pages\EditBureauDouanier::route('/{record}/edit'),
        ];
    }
}
