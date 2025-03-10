<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    
    protected static ?string $navigationLabel = 'Boekingen';

    protected static ?string $modelLabel = 'Boeking';

    protected static ?string $pluralModelLabel = 'Boekingen';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Naam')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone_number')
                            ->label('Telefoonnummer')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('start_date')
                            ->label('Start Datum')
                            ->required()
                            ->native(false),
                        Forms\Components\DatePicker::make('end_date')
                            ->label('Eind Datum')
                            ->required()
                            ->native(false)
                            ->afterOrEqual('start_date'),
                        Forms\Components\CheckboxList::make('extras')
                            ->label('Extra Opties')
                            ->options([
                                'photobooth' => 'Photobooth',
                                'lights' => 'Priklichten',
                                'foodtruck' => 'Foodtruck',
                            ])
                            ->columns(3),
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'In behandeling',
                                'confirmed' => 'Bevestigd',
                                'cancelled' => 'Geannuleerd',
                            ])
                            ->default('pending')
                            ->required(),
                        Forms\Components\Textarea::make('notes')
                            ->label('Notities')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Naam')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->label('Telefoonnummer')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Start Datum')
                    ->date('d-m-Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->label('Eind Datum')
                    ->date('d-m-Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('extras')
                    ->label('Extra Opties')
                    ->formatStateUsing(fn ($state): string => is_array($state) ? implode(', ', $state) : '')
                    ->wrap(),
                Tables\Columns\SelectColumn::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'In behandeling',
                        'confirmed' => 'Bevestigd',
                        'cancelled' => 'Geannuleerd',
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Aangemaakt op')
                    ->dateTime('d-m-Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'In behandeling',
                        'confirmed' => 'Bevestigd',
                        'cancelled' => 'Geannuleerd',
                    ]),
                Tables\Filters\Filter::make('start_date')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('Vanaf'),
                        Forms\Components\DatePicker::make('until')
                            ->label('Tot'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('start_date', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('start_date', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
