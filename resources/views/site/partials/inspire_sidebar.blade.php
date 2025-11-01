<div class="sidebar-category">

    <div class="sidebar-top">
        <h2 class="sidebar-title">{{ __('Category') }}</h2>
        <button class="sidebar-close-btn" data-mobile-menu-close-btn>
            <ion-icon name="close-outline"></ion-icon>
        </button>
    </div>

    <ul class="sidebar-menu-category-list">
        @forelse($categories as $category)
            <li class="sidebar-menu-category">
                <button class="sidebar-accordion-menu" data-accordion-btn>
                    <div class="menu-title-flex">
                        <img src="{{ asset('inspire/assets/images/icons/bag.svg') }}" alt="icon" width="20" height="20" class="menu-title-img">
                        <div class="category-content-flex">
                            <p class="menu-title">{{ app()->getLocale() == 'ar' ? ($category->name_ar ?: $category->name) : $category->name }}</p>
                            <p class="category-item-amount">({{ $category->products->count() }})</p>
                        </div>
                    </div>
                    <div>
                        <ion-icon name="add-outline" class="add-icon"></ion-icon>
                        <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                    </div>
                </button>

                @if(!$category->items->isEmpty())
                    <ul class="sidebar-submenu-category-list" data-accordion>
                        @foreach ($category->items as $subCategory)
                            <li class="sidebar-submenu-category">
                                <a href="{{ route('categories.show', $subCategory->slug) }}" class="sidebar-submenu-title">
                                    <p class="product-name">{{ app()->getLocale() == 'ar' ? ($subCategory->name_ar ?: $subCategory->name) : $subCategory->name }}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @empty
            <li class="sidebar-menu-category">
                <p class="menu-title">{{ __('No active categories') }}</p>
            </li>
        @endforelse
    </ul>

</div>

<div class="product-showcase">
    <h3 class="showcase-heading">{{ __('Best sellers') }}</h3>
    <div class="showcase-wrapper">
        <div class="showcase-container">
            @foreach(($featured_products ?? []) as $product)
                <div class="showcase">
                    <a href="{{ route('products.show', $product->slug) }}" class="showcase-img-box">
                        <img src="{{ $product->images ? asset('uploads/' . $product->images[0]) : asset('inspire/assets/images/products/1.jpg') }}" alt="{{ $product->name }}" width="75" height="75" class="showcase-img">
                    </a>
                    <div class="showcase-content">
                        <a href="{{ route('products.show', $product->slug) }}">
                            <h4 class="showcase-title">{{ app()->getLocale() == 'ar' && $product->name_ar ? $product->name_ar : $product->name }}</h4>
                        </a>
                        <div class="price-box">
                            <del>
                                {{ $product->sale_price > 0 ? number_format($product->unit_price) : '' }}
                            </del>
                            <p class="price">{{ number_format($product->sale_price > 0 ? $product->sale_price : $product->unit_price) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


