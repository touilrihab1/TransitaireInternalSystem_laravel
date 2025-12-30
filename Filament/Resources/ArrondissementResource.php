<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArrondissementResource\Pages;
use App\Filament\Resources\ArrondissementResource\RelationManagers;
use App\Models\Arrondissement;
use App\Models\bureauDouanier;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArrondissementResource extends Resource
{
    protected static ?string $model = Arrondissement::class;

    protected static ?string $navigationGroup = 'Bureaus';
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('code_b')
                    ->label('Bureau Douanière')
                    ->required()
                    ->options(bureauDouanier::all(['bureau_d', 'code'])->pluck('fullname', 'code'))
                    ->searchable()
                    // ->getSearchResultsUsing(fn (string $query) => bureauDouanier::where('bureau_d', 'like', "%{$query}%")->pluck('bureau_d', 'code'))
                    // ->getOptionLabelUsing(fn ($value): ?string => bureauDouanier::find($value)?->getAttribute('bureau_d'))
                    ,
                Forms\Components\TextInput::make('intitule_b')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('code_a')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('intitule_a')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code_b')
                    ->toggleable()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('intitule_b')
                    ->toggleable()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('code_a'),
                Tables\Columns\TextColumn::make('intitule_a'),
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
            'index' => Pages\ListArrondissements::route('/'),
            'create' => Pages\CreateArrondissement::route('/create'),
            'edit' => Pages\EditArrondissement::route('/{record}/edit'),
        ];
    }
}
