<?php

namespace App\Filament\Resources\BureauDouanierResource\Pages;

use App\Filament\Resources\BureauDouanierResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBureauDouanier extends EditRecord
{
    protected static string $resource = BureauDouanierResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
