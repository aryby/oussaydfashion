@extends('site.app')

@section('title', __('legal_notice.title'))

@section('content')
    <div class="container">
        <h1>@lang('legal_notice.page_heading')</h1>
        <p>@lang('legal_notice.content')</p>
    </div>
@endsection