@extends('site.app')

@section('title', __('Prices Drop'))

@section('content')
<section class="section-pagetop bg-dark">
    <div class="container clearfix">
        {{-- create translate ar/en for products.price_drop --}}
        <h2 class="title-page">{{ __('products.prices_drop') }}</h2>
    </div>
</section>

<div class="product-container">
    <div class="container">
        <div class="product-box">
            <div class="product-main">
                <h2 class="title">{{ __('products.prices_drop') }}</h2>
                <div class="product-grid">
                    @forelse ($products as $product)
                        @include('site.partials.products')
                    @empty
                        <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">
                            <p style="font-size: 18px; color: #666;">{{ __('products.not.found') }}</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection