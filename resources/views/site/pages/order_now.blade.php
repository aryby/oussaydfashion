@extends('site.app')
@section('title', __('Order Now'))
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">{{ __('Product Details') }}</div>
                <div class="card-body">
                    @include('site.partials.product_details', ['product' => $product])
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-5">
            <div class="card">
                <div class="card-header bg-primary text-white">{{ __('Order Now') }} - {{ $product->name }}</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('products.order-now.submit', $product->slug) }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label>{{ __('Name') }}</label>
                            <input type="text" name="name" class="form-control" required value="{{ auth()->check() ? auth()->user()->first_name . ' ' . auth()->user()->last_name : '' }}">
                        </div>
                        <div class="form-group mb-3">
                            <label>{{ __('Email (optionnel)') }}</label>
                            <input type="email" name="email" class="form-control" value="{{ auth()->check() ? auth()->user()->email : '' }}">
                        </div>
                        <div class="form-group mb-3">
                            <label>{{ __('Phone') }}</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>{{ __('Address') }}</label>
                            <textarea name="address" class="form-control" required></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label>{{ __('Payment Method') }}</label>
                            <input type="text" class="form-control" value="Cash On Delivery" readonly>
                        </div>
                        <button type="submit" class="btn btn-success w-100">{{ __('Confirm Order') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
