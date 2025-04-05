<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PhotoResource\Pages;
use App\Filament\Resources\PhotoResource\RelationManagers;
use App\Models\Photo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PhotoResource extends Resource
{
    protected static ?string $model = Photo::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    
    protected static ?string $navigationLabel = 'Photo Gallery';
    
    protected static ?string $navigationGroup = 'Content';
    
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Photo Details')
                    ->schema([
                        Forms\Components\FileUpload::make('image_path')
                            ->label('Photo')
                            ->image()
                            ->imageEditor()
                            ->required()
                            ->directory('images')
                            ->disk('public')
                            ->columnSpanFull()
                            ->afterStateUpdated(function (Forms\Get $get, Forms\Set $set, ?string $state) {
                                // Auto-generate title from filename if not provided
                                if (!$get('title') && $state) {
                                    $filename = pathinfo($state, PATHINFO_FILENAME);
                                    $set('title', Str::title(str_replace(['-', '_'], ' ', $filename)));
                                }
                                
                                // Auto-detect image dimensions
                                if ($state) {
                                    $path = Storage::disk('public')->path($state);
                                    if (file_exists($path)) {
                                        [$width, $height] = getimagesize($path);
                                        $set('width', $width);
                                        $set('height', $height);
                                    } else {
                                        // Fallback to HD resolution
                                        $set('width', 1280);
                                        $set('height', 720);
                                    }
                                }
                            }),
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('alt_text')
                            ->label('Alt Text')
                            ->helperText('Descriptive text for accessibility')
                            ->maxLength(255),
                        Forms\Components\Hidden::make('width')
                            ->default(1280),
                        Forms\Components\Hidden::make('height')
                            ->default(720),
                        Forms\Components\TextInput::make('order_column')
                            ->numeric()
                            ->label('Display Order')
                            ->helperText('Lower numbers appear first')
                            ->default(0),
                        Forms\Components\Toggle::make('is_published')
                            ->label('Published')
                            ->default(true)
                            ->helperText('Toggle to show/hide this photo on the website'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Photo')
                    ->disk('public')
                    ->square(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('alt_text')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('is_published')
                    ->boolean()
                    ->label('Published'),
                Tables\Columns\TextColumn::make('order_column')
                    ->numeric()
                    ->sortable()
                    ->label('Order'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order_column')
            ->reorderable('order_column')
            ->filters([
                Tables\Filters\SelectFilter::make('is_published')
                    ->options([
                        true => 'Published',
                        false => 'Hidden',
                    ])
                    ->label('Status'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('togglePublish')
                        ->label('Toggle Published Status')
                        ->icon('heroicon-o-eye')
                        ->action(function (Collection $records): void {
                            foreach ($records as $record) {
                                $record->update([
                                    'is_published' => !$record->is_published,
                                ]);
                            }
                        }),
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
            'index' => Pages\ListPhotos::route('/'),
            'create' => Pages\CreatePhoto::route('/create'),
            'edit' => Pages\EditPhoto::route('/{record}/edit'),
        ];
    }
}
