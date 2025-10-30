@extends('site.app')

@section('content')
    <div class="container">
        <h2 class="title-page">{{ __('Wishlist') }}</h2>
        @if ($wishlistItems->count() > 0)
            <div class="row">
                @foreach ($wishlistItems as $item)
                    <div class="col-md-3">
                        <figure class="card card-product">
                            @if ($item->product->images)
                                <div class="img-wrap">
                                    <a href="{{ route('products.show', $item->product->slug) }}"><img
                                            src="{{ asset('uploads/' . $item->product->images[0]) }}"></a>
                                </div>
                            @else
                                <div class="img-wrap">
                                    <a href="https://via.placeholder.com/176"><img src="https://via.placeholder.com/176"></a>
                                </div>
                            @endif
                            <figcaption class="info-wrap">
                                <h5 class="title">{{ $item->product->name }}</h5>
                                <div class="price-wrap h5">
                                    @if ($item->product->sale_price > 0)
                                        <span
                                            class="price-new"><small><sup>{{ env('CURRENCY_SYMBOLE') }}</sup></small>{{ number_format($item->product->sale_price) }}</span>
                                        <small><small><sup>{{ env('CURRENCY_SYMBOLE') }}</sup></small><del
                                                class="price-old">{{ number_format($item->product->unit_price) }}</del></small>
                                    @else
                                        <span
                                            class="price-new"><small><sup>{{ env('CURRENCY_SYMBOLE') }}</sup></small>{{ number_format($item->product->unit_price) }}</span>
                                    @endif
                                </div>
                            </figcaption>
                            <div class="bottom-wrap">
                                <a href="{{ route('wishlist.removeItem', $item->id) }}" class="btn btn-sm btn-outline-danger float-right">{{ __('Remove') }}</a>
                                <a href="{{ route('products.show', $item->product->slug) }}" class="btn btn-sm btn-outline-primary float-left">{{ __('View Product') }}</a>
                            </div>
                        </figure>
                    </div>
                @endforeach
            </div>
        @else
            <p>{{ __('Your wishlist is empty.') }}</p>
        @endif
    </div>
@endsection