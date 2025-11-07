<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Ticket #{{ $invoice->getSerialNumber() }}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        
        <style type="text/css" media="screen">
            @import url(https://fonts.googleapis.com/earlyaccess/lateef.css);
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            html {
                font-family: 'Courier New', 'Courier', monospace;
                line-height: 1.15;
            }

            @page {
                size: 80mm auto;
                margin: 3mm 2mm;
            }

            body {
                font-family: 'Courier New', 'Courier', monospace;
                font-weight: 400;
                line-height: 1.2;
                color: #000;
                background-color: #fff;
                font-size: 11px;
                padding: 2mm;
                width: 72mm;
                max-width: 72mm;
                margin: 0 auto;
                
                @if( str_replace('_', '-', app()->getLocale()) == 'ar')
                    direction: rtl;
                    text-align: right;
                    font-family: 'Courier New', 'Courier', monospace;
                @else
                    text-align: left;
                @endif
            }

            .ticket-header {
                text-align: center;
                border-bottom: 1px dashed #000;
                padding-bottom: 5px;
                margin-bottom: 5px;
            }

            .logo {
                max-width: 50px;
                height: auto;
                margin-bottom: 2px;
            }

            .site-name {
                font-size: 13px;
                font-weight: bold;
                margin: 2px 0;
                word-wrap: break-word;
            }

            .ticket-info {
                margin: 4px 0;
                font-size: 10px;
                line-height: 1.3;
            }

            .ticket-info strong {
                font-weight: bold;
            }

            .section {
                margin: 4px 0;
                padding: 3px 0;
                border-bottom: 1px dashed #ccc;
            }

            .section-title {
                font-weight: bold;
                font-size: 11px;
                margin-bottom: 2px;
                text-transform: uppercase;
            }

            .customer-info {
                font-size: 10px;
                line-height: 1.3;
            }

            .items-table {
                width: 100%;
                border-collapse: collapse;
                margin: 4px 0;
                font-size: 10px;
                table-layout: fixed;
            }

            .items-table th {
                text-align: left;
                font-size: 9px;
                font-weight: bold;
                padding: 2px 1px;
                border-bottom: 1px solid #000;
                @if( str_replace('_', '-', app()->getLocale()) == 'ar')
                    text-align: right;
                @endif
            }

            .items-table td {
                padding: 2px 1px;
                font-size: 10px;
                border-bottom: 1px dashed #ddd;
                vertical-align: top;
                word-wrap: break-word;
                overflow-wrap: break-word;
                @if( str_replace('_', '-', app()->getLocale()) == 'ar')
                    text-align: right;
                @endif
            }

            .item-name {
                width: 50%;
                word-wrap: break-word;
                overflow-wrap: break-word;
            }

            .item-qty {
                text-align: center;
                width: 12%;
            }

            .item-price {
                text-align: right;
                width: 38%;
                white-space: nowrap;
            }

            .total-row {
                border-top: 1px solid #000;
                border-bottom: 1px solid #000;
                font-weight: bold;
                padding: 3px 1px;
                margin-top: 3px;
            }

            .total-row td {
                border: none;
                padding: 3px 1px;
                font-size: 11px;
            }

            .footer {
                text-align: center;
                margin-top: 5px;
                padding-top: 5px;
                border-top: 1px dashed #000;
                font-size: 9px;
            }

            .status {
                display: inline-block;
                padding: 1px 4px;
                border: 1px solid #000;
                font-size: 9px;
                font-weight: bold;
                margin: 2px 0;
            }

            .separator {
                border-top: 1px dashed #000;
                margin: 4px 0;
            }

            .text-center {
                text-align: center;
            }

            .text-right {
                text-align: right;
            }

            .line {
                border-top: 1px solid #000;
                margin: 3px 0;
            }
        </style>
    </head>

    <body>
        {{-- Header --}}
        <div class="ticket-header">
            @if($invoice->logo)
                @php
                    $publicImagePath = 'uploads/' . $invoice->logo;
                    $fullPublicPath = public_path($publicImagePath);
                @endphp
                @if(file_exists($fullPublicPath))
                    <img src="{{ asset($publicImagePath) }}" alt="logo" class="logo">
                @endif
            @endif
            <div class="site-name">{{ $invoice->seller->name ?? config('settings.site_name.value', 'Store') }}</div>
        </div>

        {{-- Order Info --}}
        <div class="ticket-info">
            <div><strong>Order #:</strong> {{ $invoice->getSerialNumber() }}</div>
            <div><strong>Date:</strong> {{ $invoice->getDate() }}</div>
            @if($invoice->status)
                <div><span class="status">{{ $invoice->status }}</span></div>
            @endif
        </div>

        {{-- Customer Info --}}
        @if($invoice->buyer->name)
        <div class="section">
            <div class="section-title">Customer</div>
            <div class="customer-info">
                <div><strong>{{ $invoice->buyer->name }}</strong></div>
                @if(isset($invoice->buyer->custom_fields['phone number']))
                    <div>Phone: {{ $invoice->buyer->custom_fields['phone number'] }}</div>
                @endif
            </div>
        </div>
        @endif

        {{-- Items --}}
        <div class="section">
            <div class="separator"></div>
            <table class="items-table">
                <thead>
                    <tr>
                        <th class="item-name">Item</th>
                        <th class="item-qty">Qty</th>
                        <th class="item-price">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoice->items as $item)
                    <tr>
                        <td class="item-name">{{ \Illuminate\Support\Str::limit($item->title, 25) }}</td>
                        <td class="item-qty">{{ $item->quantity }}</td>
                        <td class="item-price">{{ $invoice->formatCurrency($item->sub_total_price) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="separator"></div>
            <table class="items-table" style="margin-top: 3px;">
                @if($invoice->shipping_amount > 0)
                <tr>
                    <td class="text-right" colspan="2" style="padding: 2px 1px;">Shipping:</td>
                    <td class="text-right" style="padding: 2px 1px;">{{ $invoice->formatCurrency($invoice->shipping_amount) }}</td>
                </tr>
                @endif
                <tr class="total-row">
                    <td colspan="2" style="padding: 3px 1px;"><strong>TOTAL:</strong></td>
                    <td class="text-right" style="padding: 3px 1px;"><strong>{{ $invoice->formatCurrency($invoice->total_amount) }}</strong></td>
                </tr>
            </table>
        </div>

        {{-- Footer --}}
        <div class="footer">
            <div>Thank you for your purchase!</div>
        </div>
    </body>
</html>

