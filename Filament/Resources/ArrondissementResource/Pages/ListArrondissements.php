<?php

namespace App\Filament\Resources\ArrondissementResource\Pages;

use App\Filament\Resources\ArrondissementResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListArrondissements extends ListRecords
{
    protected static string $resource = ArrondissementResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
