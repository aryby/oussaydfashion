@extends('site.app')

@section('title', __('home.title'))

@section('content')
    @if (Session::has('message'))
        <div>
            <p class="alert alert-warning">{{ Session::get('message') }}</p>
        </div>
    @endif

    @include('site.partials.slider')

    <div class="product-container">
        <div class="container">
            <div class="sidebar has-scrollbar" data-mobile-menu>
                @include('site.partials.inspire_sidebar')
            </div>

            <div class="product-box">
                @include('site.partials.featured_categories')
                @include('site.partials.featured_products')
                @include('site.partials.recently_added_products')
            </div>
        </div>
    </div>

    @include('site.partials.testmonials')
@endsection
