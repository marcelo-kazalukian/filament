<?php

namespace App\Filament\Guest\Widgets;

use App\Enums\StreamerStatus;
use App\Models\Streamer;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestStreamers extends BaseWidget
{

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Streamer::query()
                    ->where('status', StreamerStatus::Approved)
                    ->latest()
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')                    
                    ->searchable()                    
                    ->sortable(),
                Tables\Columns\TextColumn::make('twitch_username')                    
                    ->searchable()                    
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()   
            ]);
    }
}
