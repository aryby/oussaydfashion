<div class="product-details-summary mb-3">
    {{-- <div class="d-flex align-items-center mb-2">
    
        <div>
            <div class="text-muted small mb-1">{{ $product->brand->name ?? '' }}</div>
            <div class="mb-1">
                <span class="font-weight-bold text-primary">
                    {{ $product->sale_price > 0 ? config('settings.currency_symbol.value') . $product->sale_price : config('settings.currency_symbol.value') . $product->unit_price }}
                </span>
                @if($product->sale_price > 0)
                    <span class="text-muted small"><del>{{ config('settings.currency_symbol.value') . $product->unit_price }}</del></span>
                @endif
            </div>
        </div>
    </div> --}}
    <div class="mb-2">
        <strong>{{ __('Description') }}:</strong>
        <div class="small">{!! app()->getLocale() == 'ar' && $product->description_ar ? $product->description_ar : $product->description !!}</div>
    </div>
    <div class="mb-2">
        <strong>{{ __('Details') }}:</strong>
        <div class="small">{!! app()->getLocale() == 'ar' && $product->details_ar ? $product->details_ar : $product->details !!}</div>
    </div>
</div>
