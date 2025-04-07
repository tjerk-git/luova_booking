<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TentResource\Pages;
use App\Models\Tent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TentResource extends Resource
{
    protected static ?string $model = Tent::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';
    
    protected static ?string $navigationLabel = 'Tent Section';
    
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Tent Section')
                    ->schema([
                        Forms\Components\TextInput::make('heading')
                            ->label('Heading')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('subheading')
                            ->label('Subheading')
                            ->required()
                            ->rows(3),
                        Forms\Components\Toggle::make('is_published')
                            ->label('Published')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('heading')
                    ->label('Heading')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subheading')
                    ->label('Subheading')
                    ->limit(50),
                Tables\Columns\IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // No delete action as we only want one tent record
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
            'index' => Pages\ListTents::route('/'),
            'create' => Pages\CreateTent::route('/create'),
            'edit' => Pages\EditTent::route('/{record}/edit'),
        ];
    }
}
