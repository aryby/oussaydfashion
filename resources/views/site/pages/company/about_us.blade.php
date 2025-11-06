@extends('site.app')

@section('title', __('about_us.title'))

@section('content')
    <div class="container">
        <h1>@lang('about_us.page_heading')</h1>
        <p>@lang('about_us.content')</p>
    </div>
@endsection