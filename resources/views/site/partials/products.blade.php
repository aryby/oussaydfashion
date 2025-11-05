    <div class="showcase">

    <div class="showcase-banner">
        @if ($product->images)
            <div class="img-wrap">
                <a href="{{ route('products.show', $product->slug) }}">
                    <img src="{{ asset('uploads/' . $product->images[0]) }}" class="showcase-img"></a>
            </div>
        @else
            <div class="img-wrap">
                <a href="{{ ('assets\images\icons\rating-5.png') }}"><img src="{{ ('assets\images\icons\rating-5.png') }}"></a>
            </div>
        @endif
        {{-- <img src="/inspire/assets/images/products/jacket-3.jpg" alt="Mens Winter Leathers Jackets" width="300"
            class="product-img default">
        <img src="/inspire/assets/images/products/jacket-4.jpg" alt="Mens Winter Leathers Jackets" width="300"
            class="product-img hover"> --}}

        <p class="showcase-badge">
            @if ($product->offer?->discount_percentage)
                <span
                    class="d-inline badge badge-success">{{ $product->offer?->discount_percentage . '% ' . __('Discount') }}
                </span>
            @endif
        </p>

        <div class="showcase-actions">

            <form action="{{ route('wishlist.addItem') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button class="btn-action" type="submit">
                    <ion-icon name="heart-outline"></ion-icon>
                </button>
            </form>

            <a href="{{ route('products.show', $product->slug) }}" class="btn-action">
                <ion-icon name="eye-outline"></ion-icon>
            </a>

            {{--  <button class="btn-action">
                <ion-icon name="repeat-outline"></ion-icon>
            </button> --}}

            <button class="btn-action">
                <ion-icon name="bag-add-outline"></ion-icon>
            </button>

        </div>

    </div>

    <div class="showcase-content">

        <a href="#" class="showcase-category">{{ Str::limit($product->name, 10) }}</a>

        <a href="{{ route('products.show', $product->slug) }}">
            <h4 class="showcase-title" style="font-size: 0.9rem; margin-top: 5px;">
                {{ Str::limit(app()->getLocale() == 'ar' && $product->description_ar ? $product->description_ar : $product->description, 20) }}
            </h4>
        </a>

        <div class="showcase-rating">
            <div class="rating-wrap d-inline">
                @php
                    $ratings_count = $product->ratings->count('star_rating');
                    if ($ratings_count > 0) {
                        $ratings_sum = $product->ratings->sum('star_rating');
                        $avg_rating = round($ratings_sum / $ratings_count, 1);
                        $stars_width = ($avg_rating / 5) * 100;
                    } else {
                        $stars_width = 0;
                    }
                @endphp
                <ul class="rating-stars" style="margin: 0;">
                    <li style="width:{{ $stars_width }}%" class="stars-active">
                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                            class="fa fa-star"></i><i class="fa fa-star"></i>
                    </li>
                    <li>
                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                            class="fa fa-star"></i><i class="fa fa-star"></i>
                    </li>
                </ul>
                <small>({{ $ratings_count }})</small>
            </div> &nbsp;
        </div>

        <div class="price-box" style="font-size: 0.9rem;">
            @if ($product->sale_price > 0)
                <span
                    class="price-new">{{ number_format($product->sale_price) }}<small><sup>{{ env('CURRENCY_SYMBOLE') }}</sup></small>
                </span>
                <small>
                    <del class="price-old">{{ number_format($product->unit_price) }}</del>
                    <small><sup>{{ env('CURRENCY_SYMBOLE') }}</sup></small></small>
            @else
                <span
                    class="price-new"><small><sup>{{ env('CURRENCY_SYMBOLE') }}</sup></small>{{ number_format($product->unit_price) }}</span>
            @endif
            {{-- <p class="price">$48.00</p>
            <del>$75.00</del> --}}
        </div>

    </div>

</div>

{{-- 
<div class="col-md-3">
    <figure class="card card-product">
        @if ($product->images)
            <div class="img-wrap">
                <a href="{{ route('products.show', $product->slug) }}"><img
                        src="{{ asset('uploads/' . $product->images[0]) }}"></a>
            </div>
        @else
            <div class="img-wrap">
                <a href="{{ ('assets\images\icons\rating-5.png') }}"><img src="{{ ('assets\images\icons\rating-5.png') }}"></a>
            </div>
        @endif
        <figcaption class="info-wrap">
            <h5 class="title">{{ $product->name }}</h5>
            <div class="rating-wrap d-inline">
                @php
                    $ratings_count = $product->ratings->count('star_rating');
                    if ($ratings_count > 0) {
                        $ratings_sum = $product->ratings->sum('star_rating');
                        $avg_rating = round($ratings_sum / $ratings_count, 1);
                        $stars_width = ($avg_rating / 5) * 100;
                    } else {
                        $stars_width = 0;
                    }
                @endphp
                <ul class="rating-stars">
                    <li style="width:{{ $stars_width }}%" class="stars-active">
                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                            class="fa fa-star"></i><i class="fa fa-star"></i>
                    </li>
                    <li>
                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                            class="fa fa-star"></i><i class="fa fa-star"></i>
                    </li>
                </ul>
                <small>({{ $ratings_count }})</small>
            </div> &nbsp;
            @if ($product->offer?->discount_percentage)
                <span
                    class="d-inline badge badge-success">{{ $product->offer?->discount_percentage . '% ' . __('Discount') }}
                </span>
            @endif
        </figcaption>
        <div class="bottom-wrap">
            <a href="{{ route('products.show', $product->slug) }}"
                class="btn btn-sm btn-outline-primary float-right">{{ __('View') }}</a>
            <div class="price-wrap h5">
                @if ($product->sale_price > 0)
                    <span
                        class="price-new"><small><sup>{{ env('CURRENCY_SYMBOLE') }}</sup></small>{{ number_format($product->sale_price) }}</span>
                    <small><small><sup>{{ env('CURRENCY_SYMBOLE') }}</sup></small><del
                            class="price-old">{{ number_format($product->unit_price) }}</del></small>
                @else
                    <span
                        class="price-new"><small><sup>{{ env('CURRENCY_SYMBOLE') }}</sup></small>{{ number_format($product->unit_price) }}</span>
                @endif
            </div>
        </div>
    </figure>
</div>
 --}}