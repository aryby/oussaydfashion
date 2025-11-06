@extends('site.app')

@section('title', __('returns.title'))

@section('content')
    <div class="container">
        <h1>@lang('returns.page_heading')</h1>
        <p>@lang('returns.content')</p>
    </div>
@endsection