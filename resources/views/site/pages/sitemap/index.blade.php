@extends('site.app')

@section('title', __('Sitemap'))

@section('content')
<section class="section-pagetop bg-dark">
    <div class="container clearfix">
        <h2 class="title-page">{{ __('Sitemap') }}</h2>
    </div>
</section>

<section class="section-content bg padding-y-sm">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-title">{{ __('Shop') }}</h3>
                        <ul>
                            <li><a href="{{ route('products.categories') }}">{{ __('All Categories') }}</a></li>
                            <li><a href="{{ route('products.new') }}">{{ __('New Products') }}</a></li>
                            <li><a href="{{ route('products.bestsales') }}">{{ __('Best Sales') }}</a></li>
                            <li><a href="{{ route('products.prices_drop') }}">{{ __('Prices Drop') }}</a></li>
                        </ul>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-title">{{ __('Our Company') }}</h3>
                        <ul>
                            <li><a href="{{ route('about.us') }}">{{ __('About Us') }}</a></li>
                            <li><a href="{{ route('delivery.info') }}">{{ __('Delivery') }}</a></li>
                            <li><a href="{{ route('legal.notice') }}">{{ __('Legal Notice') }}</a></li>
                            <li><a href="{{ route('terms.conditions') }}">{{ __('Terms and Conditions') }}</a></li>
                            <li><a href="{{ route('secure.payment') }}">{{ __('Secure Payment') }}</a></li>
                        </ul>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-title">{{ __('Services') }}</h3>
                        <ul>
                            <li><a href="{{ route('services.shipping') }}">{{ __('Shipping Info') }}</a></li>
                            <li><a href="{{ route('services.returns') }}">{{ __('Returns & Refunds') }}</a></li>
                            <li><a href="{{ route('services.warranty') }}">{{ __('Warranty') }}</a></li>
                            <li><a href="{{ route('services.faq') }}">{{ __('FAQ') }}</a></li>
                            <li><a href="{{ route('services.gift_cards') }}">{{ __('Gift Cards') }}</a></li>
                        </ul>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-title">{{ __('Other') }}</h3>
                        <ul>
                            <li><a href="{{ route('contact.index') }}">{{ __('Contact Us') }}</a></li>
                            <li><a href="{{ route('products.search') }}">{{ __('Search Products') }}</a></li>
                            <li><a href="{{ route('sitemap.index') }}">{{ __('Sitemap') }}</a></li>
                        </ul>
                    </div>
                </div>

                @php
                    $categories = App\Models\Category::all();
                @endphp
                @if($categories->count() > 0)
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-title">{{ __('Popular Categories') }}</h3>
                        <div class="row">
                            @foreach($categories as $category)
                                <div class="col-md-4">
                                    <ul>
                                        <li><a href="{{ route('categories.show', $category->slug) }}">{{ $category->name }}</a></li>
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

<style>
    .card-body ul {
        list-style: none;
        padding-left: 0;
    }
    
    .card-body ul li {
        padding: 5px 0;
    }
    
    .card-body ul li a {
        color: #333;
        text-decoration: none;
    }
    
    .card-body ul li a:hover {
        color: #007bff;
    }
    
    .card-title {
        margin-bottom: 20px;
        font-weight: 600;
        border-bottom: 2px solid #007bff;
        padding-bottom: 10px;
    }
</style>