<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;
use App\Filament\Resources\RoomResource\RelationManagers;
use App\Models\Room;
use App\Models\Rooms;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoomResource extends Resource
{
    protected static ?string $model = Rooms::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('hotel_id')
                    ->relationship('hotel', 'name')
                    ->required()
                    ->label('Hotel'),
                TextInput::make('room_number')
                    ->required()
                    ->label('Room Number'),
                TextInput::make('room_type')
                    ->required()
                    ->label('Room Type'),
                TextInput::make('rate')
                    ->required()
                    ->numeric()
                    ->label('Rate'),
                Select::make('status')
                    ->required()
                    ->options([
                        'available' => 'Available',
                        'booked' => 'Booked',
                        'maintenance' => 'Maintenance',
                        'unavailable' => 'Unavailable',
                    ])
                    ->label('Status'),
                TextInput::make('capacity')
                    ->required()
                    ->numeric()
                    ->label('Capacity'),
                Textarea::make('description')
                    ->label('Description')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('room_number')
                    ->sortable()
                    ->searchable()
                    ->label('Room Number'),
                Tables\Columns\TextColumn::make('room_type')
                    ->sortable()
                    ->searchable()
                    ->label('Room Type'),
                Tables\Columns\TextColumn::make('rate')
                    ->sortable()
                    ->label('Rate'),
                Tables\Columns\TextColumn::make('status')
                    ->sortable()
                    ->label('Status'),
                Tables\Columns\TextColumn::make('capacity')
                    ->sortable()
                    ->label('Capacity'),
                Tables\Columns\TextColumn::make('hotel.name')
                    ->sortable()
                    ->label('Hotel'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Created At'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('Updated At'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
        ];
    }
}
