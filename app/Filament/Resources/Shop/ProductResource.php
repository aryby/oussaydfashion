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

    protected static ?string $navigationGroup = null;

    protected static ?string $navigationIcon = 'heroicon-s-bolt';

    protected static ?string $navigationLabel = null;

    protected static ?int $navigationSort = 3;

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'brand.name', 'unit_price'];
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.resources.ProductResource.navigation_group');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.ProductResource.navigation_label');
    }

    public static function getGlobalSearchResultDetails($record): array
    {
        return [
            __('filament.resources.ProductResource.global_search_brand') => $record->brand->name,
            __('filament.resources.ProductResource.global_search_unit_price') => $record->unit_price,
            __('filament.resources.ProductResource.global_search_sale_price') => $record->sale_price,
            __('filament.resources.ProductResource.global_search_qty') => $record->qty,
            __('filament.resources.ProductResource.global_search_active') => $record->active ? 'Yes' : 'No',
            __('filament.resources.ProductResource.global_search_featured') => $record->featured ? 'Yes' : 'No',
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
                                            ->required()
                                            ->label(__('filament.resources.ProductResource.fields.name')),
                                        \Filament\Forms\Components\Textarea::make('description')
                                            ->label(__('filament.resources.ProductResource.fields.description'))
                                            ->rows(5)
                                            ->columnSpanFull(),
                                        \Filament\Forms\Components\Textarea::make('details')
                                            ->label(__('filament.resources.ProductResource.fields.details'))
                                            ->rows(5)
                                            ->columnSpanFull(),
                                    ]),
                                Tabs\Tab::make('Arabic')
                                    ->schema([
                                                TextInput::make('name_ar')
                                                    ->label(__('filament.resources.ProductResource.fields.name_ar'))
                                                    ->placeholder(fn ($get) => $get('name')),
                                                \Filament\Forms\Components\Textarea::make('description_ar')
                                                    ->label(__('filament.resources.ProductResource.fields.description_ar'))
                                                    ->placeholder(fn ($get) => $get('description'))
                                                    ->rows(5)
                                                    ->columnSpanFull(),
                                                \Filament\Forms\Components\Textarea::make('details_ar')
                                                    ->label(__('filament.resources.ProductResource.fields.details_ar'))
                                                    ->placeholder(fn ($get) => $get('details'))
                                                    ->rows(5)
                                                    ->columnSpanFull(),
                                    ]),
                            ])->columnSpanFull(),

                        TextInput::make('model')
                            ->label(__('filament.resources.ProductResource.fields.model')),
                        Select::make('brand_id')
                            ->required()
                            ->label(__('filament.resources.ProductResource.fields.brand_id'))
                            ->relationship('brand', 'name')
                            ->options(Brand::all()->pluck('name', 'id'))
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->unique(ignoreRecord: true),
                                FileUpload::make('logo')
                                    ->directory('uploads')
                                    ->visibility('public'),
                            ]),
                        Select::make('categories')
                            ->label(__('filament.resources.ProductResource.fields.categories'))
                            ->relationship('categories', app()->getLocale() == 'ar' ? 'name_ar' : 'name')
                    ->options(Category::orderByRaw('-name ASC')->get()->nest()->listsFlattened('name'))
                            ->required(),
                        Section::make('Images')
                            ->schema([
                                FileUpload::make('images')
                                    ->multiple()
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
                            ->label(__('filament.resources.ProductResource.fields.qty'))
                            ->numeric(),
                        TextInput::make('weight')
                            ->label(__('filament.resources.ProductResource.fields.weight'))
                            ->numeric(),
                        TextInput::make('unit_price')
                            ->required()
                            ->label(__('filament.resources.ProductResource.fields.unit_price'))
                            ->numeric(),
                        TextInput::make('sale_price')
                            ->label(__('filament.resources.ProductResource.fields.sale_price'))
                            ->numeric(),
                        Toggle::make('active')
                            ->label(__('filament.resources.ProductResource.fields.active'))
                            ->default(true)
                            ->inline(),
                        Toggle::make('featured')
                            ->label(__('filament.resources.ProductResource.fields.featured'))
                            ->inline(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label(__('filament.resources.ProductResource.columns.id'))
                    ->toggleable(),
                ImageColumn::make('images')
                    ->label(__('filament.resources.ProductResource.columns.images'))
                    ->limit(1)
                    ->toggleable(),
                TextColumn::make('name')
                    ->label(__('filament.resources.ProductResource.columns.name'))
                    ->limit(15)
                    ->description(fn (Product $record): string => $record->description ? Str::limit(strip_tags($record->description), 20, '...') : ''),
                TextColumn::make('ratings_count')
                    ->counts('ratings')
                    ->label(__('filament.resources.ProductResource.columns.ratings_count'))
                    ->toggleable(),
                TextColumn::make('brand.name')
                    ->label(__('filament.resources.ProductResource.columns.brand_name')),
                TextColumn::make('categories.name')
                    ->label(__('filament.resources.ProductResource.columns.categories_name'))
                    ->badge()
                    ->toggleable(),
                TextColumn::make('qty')
                    ->label(__('filament.resources.ProductResource.columns.qty'))
                    ->toggleable(),
                TextColumn::make('unit_price')
                    ->label(__('filament.resources.ProductResource.columns.unit_price'))
                    ->toggleable(),
                TextColumn::make('sale_price')
                    ->label(__('filament.resources.ProductResource.columns.sale_price'))
                    ->toggleable(),
                ToggleColumn::make('active')
                    ->label(__('filament.resources.ProductResource.columns.active'))
                    ->toggleable(),
                ToggleColumn::make('featured')
                    ->label(__('filament.resources.ProductResource.columns.featured'))
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
