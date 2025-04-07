<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Services\ImageService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    
    protected static ?string $navigationLabel = 'Products';
    
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Product Information')
                    ->schema([
                        Forms\Components\Hidden::make('name'),
                        Forms\Components\TextInput::make('title')
                            ->label('Product Title')
                            ->required()
                            ->maxLength(255)
                            ->afterStateUpdated(function (string $state, callable $set) {
                                // Generate a slug from the title for the name field
                                $set('name', Str::slug($state));
                            }),
                        Forms\Components\Toggle::make('is_published')
                            ->label('Published')
                            ->default(true),
                        Forms\Components\FileUpload::make('image')
                            ->label('Product Image')
                            ->image()
                            ->disk('public')
                            ->directory('products')
                            ->visibility('public')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/jpg'])
                            ->required(),
                        Forms\Components\RichEditor::make('content')
                            ->label('Product Content')
                            ->toolbarButtons([
                                'blockquote',
                                'bold',
                                'bulletList',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'underline',
                                'undo',
                            ])
                            ->required()
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->disk('public')
                    ->square(),
                Tables\Columns\IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('order_column')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function (Product $record) {
                        // Delete associated image when deleting a product
                        if ($record->image) {
                            Storage::disk('public')->delete($record->image);
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function ($records) {
                            foreach ($records as $record) {
                                if ($record->image) {
                                    Storage::disk('public')->delete($record->image);
                                }
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
    
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->latest();
    }
}
