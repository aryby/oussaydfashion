<div>
    <span wire:key="refresh-{{ $refreshKey }}" style="display: none;"></span>
    <section class="section-pagetop bg-dark">
        <div class="container clearfix">
            <h4 class="title-page text-white">{{ __('Shopping Cart') }}</h4>
        </div>
    </section>
    <section class="section-content bg padding-y border-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @if (Session::has('empty_cart_warning'))
                        <p class="alert alert-warning">{{ __(Session::get('empty_cart_warning')) }}</p>
                    @endif
                    @if (Session::has('payment_type_warning'))
                        <p class="alert alert-danger">{{ __(Session::get('payment_type_warning')) }}</p>
                    @endif
                    @if (Session::has('error'))
                        <p class="alert alert-danger">{{ Session::get('error') }}</p>
                    @endif
                </div>
            </div>
            <div class="row">
                <main class="col-12 col-md-8">
                    @if (\Cart::session(auth()->id())->isEmpty())
                        <p class="alert alert-warning">{{ __('No items to display') }}.</p>
                    @else
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-hover shopping-cart-wrap table-sm">
                                    <thead class="text-muted">
                                        <tr>
                                            <th scope="col">{{ __('Product') }}</th>
                                            <th scope="col" width="80">{{ __('Qte') }}</th>
                                            <th scope="col" width="120">{{ __('Total') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (\Cart::session(auth()->id())->getContent() as $item)
                                            <tr wire:key="cart-item-{{ $item->id }}">
                                                <td>
                                                    <figure class="media">
                                                        <div class="img-wrap">
                                                            @php
                                                                $firstImage = data_get($item->associatedModel->images, '0');
                                                                $imagePath = $firstImage ? asset('uploads/' . $firstImage) : asset('assets/images/placeholder.png');
                                                            @endphp
                                                            <img src="{{ $imagePath }}" class="img-thumbnail img-sm">
                                                        </div>
                                                        <figcaption class="media-body">
                                                            <p class="small mb-1">
                                                                {{ Str::limit($item->name, 50) }}
                                                            </p>
                                                            @foreach ($item->attributes as $key => $value)
                                                                <span class="badge badge-info badge-sm mr-1 mb-1">
                                                                    {{ ucwords($key) }}: {{ ucwords($value) }}
                                                                </span>
                                                            @endforeach
                                                        </figcaption>
                                                    </figure>
                                                </td>
                                                <td wire:key="quantity-{{ $item->id }}-{{ $item->quantity }}">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <button class="p-0 m-0" style="border: none; color:grey; font-weight:400; font-size:10px" 

                                                                type="button"
                                                                wire:click="decrementQuantity('{{ $item->id }}')"
                                                                @if($item->quantity <= 1) disabled @endif>
                                                            <i class="fa fa-minus"></i>
                                                        </button>
                                                        <span class="mx-2" style="min-width: 30px; text-align: center; font-weight: 500;">
                                                            {{ $item->quantity }}
                                                        </span>
                                                        <button class="p-0 m-0" style="border: none; color:grey; font-weight:400; font-size:10px"
                                                                type="button"
                                                                wire:click="incrementQuantity('{{ $item->id }}')">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td wire:key="total-{{ $item->id }}-{{ $item->quantity }}">
                                                    <div class="price-wrap">
                                                        <var
                                                            class="price"><small><sup>{{ config('settings.currency_symbol.value') }}</sup></small>{{ number_format($item->price * $item->quantity) }}</var>
                                                    </div>
                                                </td>
                                                <td class="text-right">
                                                    <button class="btn btn-outline-danger btn-sm"
                                                        wire:click="removeItem('{{ $item->id }}')"><i
                                                            class="fa fa-trash-alt"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot wire:key="cart-totals-{{ \Cart::session(auth()->id())->getTotalQuantity() }}">
                                        <tr>
                                            <td></td>
                                            <td><strong>{{ __('Total Quantity') }}: {{ \Cart::session(auth()->id())->getTotalQuantity() }}</strong></td>
                                            <td><strong>{{ __('Total') }}: <small><sup>{{ config('settings.currency_symbol.value') }}</sup></small>{{ number_format(\Cart::session(auth()->id())->getSubTotal() + (float) config('settings.shipping_cost.value')) }}</strong></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    @endif
                </main>
                <aside class="col-12 col-md-4" wire:key="cart-sidebar-{{ \Cart::session(auth()->id())->getSubTotal() }}">
                    @if (config('settings.shipping_cost.value') > 0)
                        <p class="alert alert-success text-center">
                            <small><sup>{{ config('settings.currency_symbol.value') }}</sup></small>{{ config('settings.shipping_cost.value') }}
                            {{ __('will be added as a shipping cost') }}
                        </p>
                    @endif
                    @if (config('settings.shipping_cost.value') > 0)
                        <dl class="dlist-align h6">
                            <dt>{{ __('Subtotal') }}:</dt>
                            <dd class="text-right">
                                <small><sup>{{ config('settings.currency_symbol.value') }}</sup></small>{{ number_format(\Cart::session(auth()->id())->getSubTotal(), 2) }}
                            </dd>
                        </dl>
                        <dl class="dlist-align h6">
                            <dt>{{ __('Shipping') }}:</dt>
                            <dd class="text-right">
                                <small><sup>{{ config('settings.currency_symbol.value') }}</sup></small>{{ config('settings.shipping_cost.value') }}
                            </dd>
                        </dl>
                        <br>
                    @endif
                    <dl class="dlist-align h6">
                        <dt>{{ __('Total') }}:</dt>
                        <dd class="text-right">
                            <small><sup>{{ config('settings.currency_symbol.value') }}</sup></small>{{ number_format(\Cart::session(auth()->id())->getSubTotal() + (float) config('settings.shipping_cost.value')) }}
                        </dd>
                    </dl>
                    <hr>
                    {{-- Checkout options --}}
                    @php
                        $isGuest = Auth::check() && Str::startsWith(Auth::user()->email, 'guest_');
                    @endphp

                    @if($isGuest)
                        {{-- Billing form for guests --}}
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title">{{ __('Billing Details') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-6 form-group">
                                        <label>{{ __('First Name') }}</label><span class="required" style="color: red"> * </span>
                                        <input type="text" wire:model="first_name" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>{{ __('Last Name') }}</label><span class="required" style="color: red"> * </span>
                                        <input type="text" wire:model="last_name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 form-group">
                                        <label>{{ __('Email') }}</label><span class="required" style="color: red"> * </span>
                                        <input type="email" wire:model="email" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>{{ __('Phone Number') }}</label><span class="required" style="color: red"> * </span>
                                        <input type="text" wire:model="phone_number" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Address') }}</label><span class="required" style="color: red"> * </span>
                                    <input type="text" wire:model="street" class="form-control" placeholder="{{ __('Enter your full address') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Order Notes') }}</label>
                                    <textarea wire:model="notes" class="form-control" rows="3" placeholder="{{ __('Any special instructions...') }}"></textarea>
                                </div>
                            </div>
                        </div>
                        <button wire:click="placeOrder" class="btn btn-info btn-md btn-block">{{ __('Cash on Delivery') }}</button>
                    @else
                        {{-- Confirm button for non-guests --}}
                        <button wire:click="placeOrder" class="btn btn-success btn-md btn-block">{{ __('Confirm Order') }}</button>
                    @endif
                    <hr>
                    <button class="btn btn-outline-danger btn-block mb-4"
                        wire:click="clear()">{{ __('Clear Cart') }}</button>
                </aside>
            </div>
        </div>
    </section>
    <section>
        @include('site.partials.featured_products')
    </section>
</div>
