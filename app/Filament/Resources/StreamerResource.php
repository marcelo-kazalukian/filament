<?php

namespace App\Filament\Resources;

use App\Enums\StreamerStatus;
use App\Filament\Resources\StreamerResource\Pages;
use App\Filament\Resources\StreamerResource\RelationManagers;
use App\Models\Streamer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StreamerResource extends Resource
{
    protected static ?string $model = Streamer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('twitch_username')
                    ->required()
                    ->unique(
                        'streamers', 
                        'twitch_username', 
                        ignoreRecord: true
                    ),
                Forms\Components\Select::make('status')
                    ->required()
                    ->default(StreamerStatus::PendingApproval)
                    ->options(StreamerStatus::class)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')                    
                    ->searchable()                    
                    ->sortable(),
                Tables\Columns\TextColumn::make('twitch_username')                    
                    ->searchable()                    
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()                    
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListStreamers::route('/'),
            'create' => Pages\CreateStreamer::route('/create'),
            'edit' => Pages\EditStreamer::route('/{record}/edit'),
        ];
    }
}
