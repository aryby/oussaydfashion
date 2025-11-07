<div>
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
                                            <tr>
                                                <td>
                                                    <figure class="media">
                                                        <div class="img-wrap"><img
                                                                src="{{ asset('upload/' . data_get($item->associatedModel->images, '0.full', 'no-image.png')) }}"
                                                                class="img-thumbnail img-sm"></div>
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
                                                <td>
                                                    <div class="col-6 p-0">
                                                        <input type="number" class="form-control form-control-sm text-center"
                                                            value="{{ $item->quantity }}" min="1" wire:change="updateQuantity('{{ $item->id }}', $event.target.value)">
                                                    </div>
                                                </td>
                                                <td>
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
                                    <tfoot>
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
                <aside class="col-12 col-md-4">
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
                    {{-- <a href="{{ route('checkout.index', ['payment_type' => 'paypal']) }}"
                        class="btn btn-primary btn-md btn-block mb-2">{{ __('Checkout with PayPal') }}</a>
                    <a href="{{ route('checkout.index', ['payment_type' => 'card']) }}"
                        class="btn btn-secondary btn-md btn-block mb-2">{{ __('Checkout with Bank Card') }}</a>
                     --}}<a href="{{ route('checkout.index', ['payment_type' => 'cash']) }}"
                        class="btn btn-info btn-md btn-block">{{ __('Cash on Delivery') }}</a>
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
