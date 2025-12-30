<?php

namespace App\Filament\Resources\BureauDouanierResource\Pages;

use App\Filament\Resources\BureauDouanierResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBureauDouaniers extends ListRecords
{
    protected static string $resource = BureauDouanierResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
