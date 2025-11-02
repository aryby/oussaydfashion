@extends('site.app')

@section('title', __('Checkout'))

@section('content')
<section class="section-content bg padding-y">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Delivery Information') }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('orders.store') }}" method="POST" id="checkoutForm">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>{{ __('First Name') }} *</label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" required>
                                    @error('first_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>{{ __('Last Name') }} *</label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" required>
                                    @error('last_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{ __('Email') }} *</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" required>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>{{ __('Phone Number') }} *</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" required>
                                @error('phone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>{{ __('Address') }} *</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" required>
                                @error('address')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>{{ __('City') }} *</label>
                                    <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" required>
                                    @error('city')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>{{ __('State') }}</label>
                                    <input type="text" class="form-control @error('state') is-invalid @enderror" name="state">
                                    @error('state')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-2">
                                    <label>{{ __('ZIP') }} *</label>
                                    <input type="text" class="form-control @error('zip') is-invalid @enderror" name="zip" required>
                                    @error('zip')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{ __('Notes') }}</label>
                                <textarea class="form-control" name="notes" rows="3"></textarea>
                            </div>
                            <hr>
                            <h3>{{ __('Payment Method') }}</h3>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="cash" name="payment_method" value="cash" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="cash">{{ __('Cash on Delivery') }}</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="card" name="payment_method" value="card" class="custom-control-input">
                                    <label class="custom-control-label" for="card">{{ __('Credit Card') }}</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                {{ __('Place Order') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Order Summary') }}</h3>
                    </div>
                    <div class="card-body">
                        <dl class="dlist-align">
                            <dt>{{ __('Product Price') }}:</dt>
                            <dd class="text-right">{{ config('settings.currency_symbol.value') }}{{ $product->sale_price > 0 ? $product->sale_price : $product->unit_price }}</dd>
                        </dl>
                        <dl class="dlist-align">
                            <dt>{{ __('Quantity') }}:</dt>
                            <dd class="text-right">{{ $quantity }}</dd>
                        </dl>
                        <dl class="dlist-align">
                            <dt>{{ __('Shipping') }}:</dt>
                            <dd class="text-right">{{ __('Free') }}</dd>
                        </dl>
                        <hr>
                        <dl class="dlist-align">
                            <dt><strong>{{ __('Total') }}:</strong></dt>
                            <dd class="text-right"><strong>{{ config('settings.currency_symbol.value') }}{{ ($product->sale_price > 0 ? $product->sale_price : $product->unit_price) * $quantity }}</strong></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection