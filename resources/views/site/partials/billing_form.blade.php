<div class="row">
    <div class="col-md-8">
        <div class="card">
            <header class="card-header">
                <h4 class="card-title mt-2">{{ __('Billing Details') }}</h4>
            </header>
            <article class="card-body">
                <div class="form-row">
                    <div class="col form-group">
                        <label>{{ __('Name') }}</label><span class="required" style="color: red"> * </span>
                        <input type="text" required class="form-control" value="{{ trim(auth()->user()->first_name . ' ' . auth()->user()->last_name) }}" name="first_name">
                    </div>
                    <div class="col form-group">
                        <label>Email &nbsp;</label>
                        <input type="email" class="form-control" name="emaail" value="" placeholder="{{ __('email') }}">
                    </div>
                    <div class="col form-group">
                        <label>{{ __('Phone Number') }}</label><span class="required" style="color: red"> * </span>
                        @error('phone_number')
                            <span class="required" style="color: red">{{ $message }}</span>
                        @enderror
                        <input type="text" class="form-control @error('phone_number') @enderror"
                            name="phone_number">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label>{{ __('Address') }}</label><span class="required" style="color: red"> * </span>
                        <input type="text" required class="form-control" name="street" value="{{ old('street') }}" placeholder="{{ __('Street, building, floor, apartment') }}">
                    </div>
                </div>
               {{--  <div class="form-row">
                    <div class="form-group col">
                        <label>{{ __('City') }}</label>
                        <input type="text" class="form-control" name="city" value="{{ old('city') ?: auth()->user()->info?->city ?? '' }}" placeholder="{{ __('Optional') }}">
                    </div>
                    <div class="form-group col">
                        <label>{{ __('State') }}</label>
                        <input type="text" class="form-control" name="state" value="{{ old('state') ?: auth()->user()->info?->state ?? '' }}" placeholder="{{ __('Optional') }}">
                    </div>
                    <div class="form-group col">
                        <label>{{ __('Country') }}</label>
                        <select id="country" class="form-control" name="country">
                            <option value="">{{ __('Optional') }}</option>
                            @foreach ($countries as $key => $value)
                                <option value="{{ $value }}" @if(old('country')===$value) selected @endif>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col">
                        <label>{{ __('Postal Code') }}</label>
                        <input type="number" class="form-control" name="postal_code" value="{{ old('postal_code') }}" placeholder="{{ __('Optional') }}">
                    </div>
                </div> --}}
                <div class="form-group">
                    <label>{{ __('Order Notes') }}</label>
                    <textarea class="form-control" name="notes" rows="4">{{ old('notes') }}</textarea>
                </div>
            </article>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title mt-2">{{ __('Payment Details') }}</h4>
                    </header>
                    <article class="card-body">
                        <dl class="dlist-align">
                            <dt>{{ __('Total') }}: </dt>
                            <dd class="text-right h5 b">
                                <small><sup>{{ config('settings.currency_symbol.value') }}</sup></small>{{ config('settings.shipping_cost.value') > 0 ? number_format(\Cart::session(auth()->id())->getSubTotal() + config('settings.shipping_cost.value')) : number_format(\Cart::session(auth()->id())->getSubTotal()) }}
                            </dd>
                        </dl>
                    </article>
                </div>
            </div>
            <div class="col-md-12 mt-4">
                <button type="submit" class="btn btn-outline-primary btn-lg btn-block">
                    {{ __('Checkout') }}
                </button>
            </div>
        </div>
    </div>
</div>
