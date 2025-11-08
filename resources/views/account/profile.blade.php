@extends('site.app')
@section('title', __('My Profile'))

@section('content')
    <div class="container py-5">
        <h2 class="text-lg font-medium text-gray-900 mb-4">
            {{ __('My Profile') }}
        </h2>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <p><strong>{{ __('First Name') }}:</strong> {{ $user->first_name }}</p>
            <p><strong>{{ __('Last Name') }}:</strong> {{ $user->last_name }}</p>
            <p><strong>{{ __('Email') }}:</strong> {{ $user->email }}</p>
            <p><strong>{{ __('Phone Number') }}:</strong> {{ $user->info?->phone_number }}</p>
            <p><strong>{{ __('Address') }}:</strong> {{ $user->info?->address }}</p>
        </div>
    </div>
@endsection
