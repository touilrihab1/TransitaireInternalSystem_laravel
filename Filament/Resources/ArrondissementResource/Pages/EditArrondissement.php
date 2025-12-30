<?php

namespace App\Filament\Resources\ArrondissementResource\Pages;

use App\Filament\Resources\ArrondissementResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditArrondissement extends EditRecord
{
    protected static string $resource = ArrondissementResource::class;

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
