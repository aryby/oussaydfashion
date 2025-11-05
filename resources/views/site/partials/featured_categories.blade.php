{{-- this section is for the featured categories, must have header title and slider for the categories --}}

{{-- here --}}
<section class="section-content section-compact-py bg">
    <div class="container">
        <div class="product-featured">

            <h2 class="title" style="margin-bottom: 20px;">{{ __('Featured Categories') }}</h2>

            <div class="category-list-container category-carousel-flex-container">
                @foreach ($featured_categories as $category)
                    <div class="showcase-container category-item-width">
                        <div class="showcase">
                            <div class="showcase-banner">
                                <div class="img-wrap">
                                    <a href="{{ route('categories.show', $category->slug) }}">
                                        <img src="{{ asset("uploads/".$category->image) }}" class="showcase-img">
                                    </a>
                                </div>
                            </div>
                            <div class="showcase-content">
                                <a href="{{ route('categories.show', $category->slug) }}">
                                    <h4 class="showcase-title" style="font-size: 0.9rem;">{{ Str::limit($category->name, 10) }}</h4>
                                </a>
                                <p class="showcase-desc" style="font-size: 0.8rem;">
                                    {{ $category->products_count }} Products
                                </p>
                                <div class="price-box" style="font-size: 0.9rem;">
                                    <a href="{{ route('categories.show', $category->slug) }}" class="btn btn-primary btn-sm">Show All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</section>
