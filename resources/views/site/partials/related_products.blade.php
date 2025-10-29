<div class="showcase">

    <div class="showcase-banner">
        @if ($related_product->images)
            <a href="{{ route('products.show', $related_product->slug) }}" class="showcase-img-box">
                <img src="{{ asset('uploads/' . $related_product->images[0]) }}" class="showcase-img" alt="{{ $related_product->name }}" style="width: 100%; height: 220px; object-fit: cover;">
            </a>
        @else
            <a href="{{ route('products.show', $related_product->slug) }}" class="showcase-img-box">
                <img src="https://via.placeholder.com/300x300" class="showcase-img" alt="{{ $related_product->name }}" style="width: 100%; height: 220px; object-fit: cover;">
            </a>
        @endif

        @if ($related_product->offer?->discount_percentage)
            <p class="showcase-badge angle black">-{{ $related_product->offer->discount_percentage }}%</p>
        @endif
    </div>

    <div class="showcase-content">
        <a href="{{ route('products.show', $related_product->slug) }}">
            <h3 class="showcase-title">{{ app()->getLocale() == 'ar' && $related_product->name_ar ? $related_product->name_ar : $related_product->name }}</h3>
        </a>

        <div class="showcase-rating">
            @php
                $ratings_count = $related_product->ratings->count('star_rating');
                if ($ratings_count > 0) {
                    $ratings_sum = $related_product->ratings->sum('star_rating');
                    $avg_rating = round($ratings_sum / $ratings_count, 1);
                    $stars_width = ($avg_rating / 5) * 100;
                } else {
                    $stars_width = 0;
                }
            @endphp
            <ul class="rating-stars" style="margin: 0;">
                <li style="width:{{ $stars_width }}%" class="stars-active">
                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                </li>
                <li>
                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                </li>
            </ul>
            <small>({{ $ratings_count }})</small>
        </div>

        <div class="price-box">
            @if ($related_product->sale_price > 0)
                <p class="price">{{ number_format($related_product->sale_price) }}</p>
                <del>{{ number_format($related_product->unit_price) }}</del>
            @else
                <p class="price">{{ number_format($related_product->unit_price) }}</p>
            @endif
        </div>
    </div>

</div>
