@extends('site.app')

@section('title', __('New Products'))

@section('content')
<section class="section-pagetop bg-dark">
    <div class="container clearfix">
        <h2 class="title-page">{{ __('New Products') }}</h2>
    </div>
</section>

<div class="product-container">
    <div class="container">
        <div class="product-box">
            <div class="product-main">
                <h2 class="title">{{ __('New Products') }}</h2>
                <div class="product-grid">
                    @forelse ($products as $product)
                        @include('site.partials.products')
                    @empty
                        <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">
                            <p style="font-size: 18px; color: #666;">{{ __('No products found') }}</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection