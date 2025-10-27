@extends('site.app')
@section('title', 'Home Page')
@section('content')
    @isset($offers)
        <div class="banner">
            <div class="container">
                <div class="slider-container has-scrollbar">
                    @foreach ($offers as $offer)
                        <div class="slider-item">
                            <img src="{{ asset('storage/' . $offer->product->image) }}" alt="{{ $offer->title }}"
                                class="banner-img">
                            <div class="banner-content">
                                <p class="banner-subtitle">{{ $offer->title }}</p>
                                <h2 class="banner-title">{{ $offer->product->name }}</h2>
                                <p class="banner-text">
                                    starting at &dollar; <b>{{ $offer->price }}</b>.00
                                </p>
                                <a href="{{ route('products.show', $offer->product->slug) }}" class="banner-btn">Shop
                                    now</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endisset

    @isset($featured_categories)
        <div class="category">
            <div class="container">
                <div class="category-item-container has-scrollbar">
                    @foreach ($featured_categories as $category)
                        <div class="category-item">
                            <div class="category-img-box">
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                    width="30">
                            </div>
                            <div class="category-content-box">
                                <div class="category-content-flex">
                                    <h3 class="category-item-title">{{ $category->name }}</h3>
                                    <p class="category-item-amount">({{ $category->products->count() }})</p>
                                </div>
                                <a href="{{ route('categories.show', $category->slug) }}" class="category-btn">Show all</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endisset

    @isset($recently_added_products)
        <div class="product-container">
            <div class="container">
                <div class="product-box">
                    <div class="product-main">
                        <h2 class="title">New Products</h2>
                        <div class="product-grid">
                            @foreach ($recently_added_products as $product)
                                <div class="showcase">
                                    <div class="showcase-banner">
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                            alt="{{ $product->name }}" width="300" class="product-img default">
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                            alt="{{ $product->name }}" width="300" class="product-img hover">
                                        @if ($product->offer)
                                            <p class="showcase-badge">{{ $product->offer->percentage }}%</p>
                                        @endif
                                        <div class="showcase-actions">
                                            <button class="btn-action">
                                                <ion-icon name="heart-outline"></ion-icon>
                                            </button>
                                            <a href="{{ route('products.show', $product->slug) }}">
                                                <button class="btn-action">
                                                    <ion-icon name="eye-outline"></ion-icon>
                                                </button>
                                            </a>
                                            <button class="btn-action">
                                                <ion-icon name="repeat-outline"></ion-icon>
                                            </button>
                                            <form action="{{ route('cart.addItem') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="productId" value="{{ $product->id }}">
                                                <input type="hidden" name="price" value="{{ $product->price }}">
                                                <button class="btn-action">
                                                    <ion-icon name="bag-add-outline"></ion-icon>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="showcase-content">
                                        <a href="{{ route('categories.show', $product->categories->first()->slug) }}"
                                            class="showcase-category">{{ $product->categories->first()->name }}</a>
                                        <a href="{{ route('products.show', $product->slug) }}">
                                            <h3 class="showcase-title">{{ $product->name }}</h3>
                                        </a>
                                        <div class="showcase-rating">
                                            @for ($i = 0; $i < floor($product->ratings->avg('rating')); $i++)
                                                <ion-icon name="star"></ion-icon>
                                            @endfor
                                            @for ($i = 0; $i < 5 - floor($product->ratings->avg('rating')); $i++)
                                                <ion-icon name="star-outline"></ion-icon>
                                            @endfor
                                        </div>
                                        <div class="price-box">
                                            <p class="price">${{ $product->price }}</p>
                                            @if ($product->offer)
                                                <del>${{ $product->price_before_offer }}</del>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
@endsection
