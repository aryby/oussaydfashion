<?php

namespace App\Filament\Resources\Shop;

use Filament\Tables;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\Shop\ProductResource\Pages;
use App\Filament\Resources\Shop\ProductResource\RelationManagers\AttributesRelationManager;
use App\Filament\Resources\Shop\ProductResource\RelationManagers\OfferRelationManager;
use App\Filament\Resources\Shop\ProductResource\RelationManagers\RatingsRelationManager;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\Tabs;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $slug = 'shop/products';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Shop';

    protected static ?string $navigationIcon = 'heroicon-s-bolt';

    protected static ?string $navigationLabel = 'Products';

    protected static ?int $navigationSort = 3;

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'brand.name', 'unit_price'];
    }

    public static function getGlobalSearchResultDetails($record): array
    {
        return [
            'Brand' => $record->brand->name,
            'Unit Price' => $record->unit_price,
            'Sale Price' => $record->sale_price,
            'QTY' => $record->qty,
            'Active' => $record->active ? 'Yes' : 'No',
            'Featured' => $record->featured ? 'Yes' : 'No',
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Product Information')
                    ->schema([
                        Tabs::make('Heading')
                            ->persistTabInQueryString()
                            ->tabs([
                                Tabs\Tab::make('English')
                                    ->schema([
                                        TextInput::make('name')
                                            ->required(),
                                        RichEditor::make('description')
                                            ->columnSpanFull(),
                                        RichEditor::make('details')
                                            ->columnSpanFull(),
                                    ]),
                                Tabs\Tab::make('Arabic')
                                    ->schema([
                                        TextInput::make('name_ar')
                                            ->required(),
                                        RichEditor::make('description_ar')
                                            ->columnSpanFull(),
                                        RichEditor::make('details_ar')
                                            ->columnSpanFull(),
                                    ]),
                            ])->columnSpanFull(),

                        TextInput::make('model'),
                        Select::make('brand_id')
                            ->required()
                            ->relationship('brand', 'name')
                            ->options(Brand::all()->pluck('name', 'id'))
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->unique(ignoreRecord: true),
                                FileUpload::make('logo')
                                    ->disk('public')
                                    ->preserveFilenames(),
                            ]),
                        Select::make('categories')
                            ->relationship('categories', 'name')
                            ->options(Category::orderByRaw('-name ASC')->get()->nest()->listsFlattened('name'))
                            ->required()
                            ->multiple()
                            ->maxItems(3),
                        Section::make('Images')
                            ->schema([
                                FileUpload::make('images')
                                    ->multiple()
                                    ->disk('public')
                                    ->preserveFileNames()
                                    ->maxFiles(5),
                            ])
                            ->collapsible(),
                    ])
                    ->columns(2),
                Section::make('Qty & Pricing')
                    ->schema([
                        TextInput::make('qty')
                            ->required()
                            ->numeric(),
                        TextInput::make('weight')
                            ->numeric(),
                        TextInput::make('unit_price')
                            ->required()
                            ->numeric(),
                        TextInput::make('sale_price')
                            ->numeric(),
                        Toggle::make('active')
                            ->default(true)
                            ->inline(),
                        Toggle::make('featured')
                            ->inline(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->toggleable(),
                ImageColumn::make('images')
                    ->limit(1)
                    ->toggleable(),
                TextColumn::make('name')
                    ->limit(15)
                    ->description(fn (Product $record): string => $record->description ? Str::limit(strip_tags($record->description), 20, '...') : ''),
                TextColumn::make('ratings_count')
                    ->counts('ratings')
                    ->label('Ratings')
                    ->toggleable(),
                TextColumn::make('brand.name'),
                TextColumn::make('categories.name')
                    ->badge()
                    ->toggleable(),
                TextColumn::make('qty')
                    ->toggleable(),
                TextColumn::make('unit_price')
                    ->toggleable(),
                TextColumn::make('sale_price')
                    ->toggleable(),
                ToggleColumn::make('active')
                    ->toggleable(),
                ToggleColumn::make('featured')
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make()->iconButton(),
                Tables\Actions\EditAction::make()->iconButton(),
                Tables\Actions\DeleteAction::make()->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            AttributesRelationManager::class,
            OfferRelationManager::class,
            RatingsRelationManager::class
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
}
