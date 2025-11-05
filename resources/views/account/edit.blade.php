@extends('site.app')
@section('title', __('My Account'))

@section('content')
    <div class="container py-5 d-flex justify-content-center">
        <div class="col-md-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h2 class="text-lg font-medium text-gray-900 mb-4 text-center">
                    {{ __('Register Account') }}
                </h2>
                @include('account.partials.update-profile-information-form')
            </div>
        </div>
    </div>
@endsection
