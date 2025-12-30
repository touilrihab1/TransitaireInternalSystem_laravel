<?php

namespace App\Filament\Resources\BureauDouanierResource\Pages;

use App\Filament\Resources\BureauDouanierResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBureauDouanier extends CreateRecord
{
    protected static string $resource = BureauDouanierResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
