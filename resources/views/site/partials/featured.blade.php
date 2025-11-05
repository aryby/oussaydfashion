<div class="showcase-container">

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
        </div>

        <div class="showcase-content">

            <div class="showcase-rating">
                {{-- <ion-icon name="star"></ion-icon>
                <ion-icon name="star"></ion-icon>
                <ion-icon name="star"></ion-icon>
                <ion-icon name="star-outline"></ion-icon>
                <ion-icon name="star-outline"></ion-icon> --}}
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

            <a href="{{ route('products.show', $product->slug) }}">
                <h4 class="showcase-title" style="font-size: 0.9rem;">{{ Str::limit($product->name, 10) }}</h4>
            </a>

            <p class="showcase-desc" style="font-size: 0.8rem;">
                <dd class="col-sm-12" style="margin-left: 0;">
                    {!! Str::limit(app()->getLocale() == 'ar' && $product->description_ar ? $product->description_ar : $product->description, 20) !!}
                </dd>
            </p>

            <div class="price-box" style="font-size: 0.9rem;">
                @if ($product->sale_price > 0)
                    <span class="price-new">{{ number_format($product->sale_price) }}
                        <small><sup>{{ env('CURRENCY_SYMBOLE') }}</sup></small></span>
                    <small>
                        <del class="price-old">{{ number_format($product->unit_price) }}</del>

                        <small>
                            <sup>{{ env('CURRENCY_SYMBOLE') }}</sup>
                        </small>
                    </small>
                @else
                    <span
                        class="price-new"><small><sup>{{ env('CURRENCY_SYMBOLE') }}</sup></small>{{ number_format($product->unit_price) }}</span>
                @endif
                {{-- <p class="price">$150.00</p>

                <del>$200.00</del> --}}
            </div>

            <div class="showcase-status">
                <div class="wrapper">
                    <p>
                        @if ($product->offer?->discount_percentage)
                            <span
                                class="d-inline badge badge-success">{{ $product->offer?->discount_percentage . '% ' . __('Discount') }}
                            </span>
                        @endif
                    </p>

                    <p>
                        En Stock
                    </p>
                </div>

                <div class="showcase-status-bar"></div>
            </div>

            <div class="countdown-box">

                <p class="countdown-desc">
                    {!! app()->getLocale() == 'ar' && $product->details_ar ? $product->details_ar : $product->description !!}

                </p>

               {{--  <div class="countdown">

                    <div class="countdown-content">

                        <p class="display-number">360</p>

                        <p class="display-text">Days</p>

                    </div>

                    <div class="countdown-content">
                        <p class="display-number">24</p>
                        <p class="display-text">Hours</p>
                    </div>

                    <div class="countdown-content">
                        <p class="display-number">59</p>
                        <p class="display-text">Min</p>
                    </div>

                    <div class="countdown-content">
                        <p class="display-number">00</p>
                        <p class="display-text">Sec</p>
                    </div>

                </div> --}}

            </div>

        </div>

    </div>

</div>
