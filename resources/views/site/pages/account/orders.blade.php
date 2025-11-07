@extends('site.app')
@section('title', __('My Orders'))
@section('content')
    <section class="section-pagetop bg-dark">
        <div class="container clearfix">
            <h2 class="title-page">{{ __('My Orders') }}</h2>
        </div>
    </section>
    <section class="section-content bg padding-y border-top">
        <div class="container">
            <div class="row">
                @if (Session::has('success'))
                    <p class="alert alert-success">{{ Session::get('success') }}
                        @if (Session::has('INVNUM'))
                            {{ __('Your order number is:') }} {{ Session::get('INVNUM') }}
                        @endif
                    </p>
                @elseif (Session::has('INVNUM'))
                    <p class="alert alert-success">{{ __('Order placed successfully. Your order number is:') }}
                        {{ Session::get('INVNUM') }}</p>
                @endif
            </div>
            <div class="row">
                <main class="col-sm-12">
                    @if ($orders->count() > 0)
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('Order No.') }}</th>
                                    <th scope="col">{{ __('Status') }}</th>
                                    <th scope="col">{{ __('Total') }}</th>
                                    <th scope="col">{{ __('Currency') }}</th>
                                    <th scope="col">{{ __('Payment Method') }}</th>
                                    <th scope="col">{{ __('Items') }}</th>
                                    <th scope="col">{{ __('Date Created') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td scope="row">{{ $order->number }}</td>
                                        <td><span class="badge badge-success">{{ __(strtoupper($order->status->value)) }}</span></td>
                                        <td>{{ number_format($order->grand_total) }}</td>
                                        <td>{{ $order->currency }}</td>
                                        <td>{{ __($order->payment_method) }}</td>
                                        <td>
                                            @foreach ($order->items as $item)
                                                <span class="">{{ $item->name }}
                                                    @if (!empty($item->attributes) && is_array($item->attributes))
                                                        @php
                                                            $attrs = $item->attributes;
                                                            // Check if it's an indexed array (from BuyNowController)
                                                            $isIndexedArray = !empty($attrs) && isset($attrs[0]) && is_array($attrs[0]);
                                                        @endphp
                                                        @if ($isIndexedArray)
                                                            {{-- Array of arrays format (from BuyNowController) --}}
                                                            @foreach ($attrs as $attr)
                                                                @if (is_array($attr) && isset($attr['value']))
                                                                    @if (isset($attr['attribute_name']))
                                                                        , {{ $attr['attribute_name'] }}: {{ $attr['value'] }}
                                                                    @else
                                                                        , {{ $attr['value'] }}
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            {{-- Simple key-value format (from regular cart) --}}
                                                            @foreach ($attrs as $key => $value)
                                                                @if (is_array($value))
                                                                    {{-- Skip array values or handle them safely --}}
                                                                @elseif (is_string($value) || is_numeric($value))
                                                                    , {{ is_string($key) ? $key . ': ' : '' }}{{ $value }}
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                    | {{ __('Qty') }}: {{ $item->qty }}
                                                </span>
                                                <br>
                                            @endforeach
                                        </td>
                                        <td>{{ Carbon\Carbon::parse($order->created_at)->isoFormat('A h:m ,dddd, D/MM/YYYY ') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="col-sm-12">
                            <p class="alert alert-warning">{{ __('No orders to display') }}</p>
                        </div>
                    @endif
                </main>
            </div>
        </div>
    </section>
@endsection
