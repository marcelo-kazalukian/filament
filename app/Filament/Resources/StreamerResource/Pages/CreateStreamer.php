<?php

namespace App\Filament\Resources\StreamerResource\Pages;

use App\Filament\Resources\StreamerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStreamer extends CreateRecord
{
    protected static string $resource = StreamerResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
