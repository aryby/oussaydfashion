@extends('site.app')

@section('title', 'All Categories')

@section('content')
    <div class="container">
        <h1>All Categories</h1>
        <div class="category-list">
            @foreach($categories as $category)
                <a href="{{ route('categories.show', $category->slug) }}" class="category-item">{{ $category->name }}</a>
            @endforeach
        </div>
    </div>
@endsection