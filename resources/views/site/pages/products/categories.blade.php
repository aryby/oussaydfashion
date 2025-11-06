@extends('site.app')

@section('title', __('product_categories.title'))

@section('content')
    <div class="container">
        <h1>@lang('product_categories.title')</h1>
        <div class="category-list">
            @foreach($categories as $category)
                <a href="{{ route('categories.show', $category->slug) }}" class="category-item">{{ $category->name }}</a>
            @endforeach
        </div>
    </div>
@endsection