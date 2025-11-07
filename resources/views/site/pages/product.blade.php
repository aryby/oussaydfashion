@extends('site.app')
@section('title', app()->getLocale() == 'ar' && $product->name_ar ? $product->name_ar : $product->name)
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-7">
            {{-- Product Image Gallery and Details --}}
            <div class="card mb-3 shadow-sm border-0">
                <div class="card-body p-3">
                    @if($product->images && count($product->images) > 0)
                        <div class="row">
                            <div class="col-12 col-md-10 order-1 order-md-2">
                                <div class="product-image-display">
                                    <img class="img-fluid rounded shadow-sm" src="{{ asset('uploads/' . $product->images[0]) }}" alt="Main Image" id="mainProductImage" style="max-height: 500px; object-fit: contain;">
                                </div>
                            </div>
                            <div class="col-12 col-md-2 mini-preview order-2 order-md-1">
                                @foreach($product->images as $index => $image)
                                    <img class="img-fluid mb-2 border p-1 rounded cursor-pointer {{ $loop->first ? 'border-primary' : '' }}" src="{{ asset('uploads/' . $image) }}" alt="Preview {{ $index + 1 }}" data-id="{{ $index + 1 }}">
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="product-image-display">
                            <img class="img-fluid rounded shadow-sm" src="{{ asset('assets/images/icons/rating-5.png') }}" alt="No Image" id="mainProductImage" style="max-height: 500px; object-fit: contain;">
                        </div>
                    @endif
                    <div class="category text-muted small mb-1">{{ __('Category') }}: {{ $product->categories->first()->name ?? 'N/A' }}</div>
                    <h4 class="mb-2 fw-bold text-break">{{ app()->getLocale() == 'ar' && $product->name_ar ? $product->name_ar : $product->name }}</h4>
                    <div class="ratings my-2 d-flex align-items-center">
                        @livewire('product-rating-wrap', ['product' => $product, 'inline' => true])
                        @if ($product->offer?->discount_percentage)
                            <span class="badge badge-success ms-2">{{ $product->offer?->discount_percentage . '% ' . __('Discount') }}</span>
                        @endif
                    </div>
                    <div class="product-price my-2 fs-4 fw-bold">
                        @if($product->sale_price > 0)
                            <span class="theme-text" id="productPrice">{{ config('settings.currency_symbol.value') }}{{ number_format($product->sale_price) }}</span>
                            <strike class="original-price text-muted fs-6 fw-normal">{{ config('settings.currency_symbol.value') }}{{ number_format($product->unit_price) }}</strike>
                        @else
                            <span class="theme-text" id="productPrice">{{ config('settings.currency_symbol.value') }}{{ number_format($product->unit_price) }}</span>
                        @endif
                    </div>
                    {{-- <div class="theme-text subtitle fw-bold mb-1">{{ __('Brief Description') }}:</div>
                    <div class="brief-description text-muted small mb-3">
                        {!! app()->getLocale() == 'ar' && $product->description_ar ? Str::limit($product->description_ar, 150) : Str::limit($product->description, 150) !!}
                    </div> --}}
                    @include('site.partials.product_details', ['product' => $product])
                </div>
            </div>
        </div>
        <div class="col-md-5">
            {{-- Product Details and Add to Cart --}}
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white text-dark text-center py-2 border-bottom">
                    <h5 class="mb-0">{{ __('Product Details') }}</h5>
                </div>
                <div class="card-body p-3">
                    @if (Session::has('added_to_cart'))
                        <div class="alert alert-success">{{ __(Session::get('added_to_cart')) }}</div>
                    @endif
                    @if (Session::has('add_to_cart_error'))
                        <div class="alert alert-danger">{{ __(Session::get('add_to_cart_error')) }}</div>
                    @endif

                

                    <form action="{{ route('cart.addItem') }}" method="POST" role="form" id="addToCart" name="addToCartForm">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="unit_price" id="finalPrice" value="{{ $product->sale_price ?: $product->unit_price }}">

                        {{-- Product Attributes --}}
                        @if ($product->attributes->isNotEmpty())
                            @php
                                $groupedAttributes = $product->attributes->groupBy('attribute.name');
                            @endphp
                            @foreach ($attributes as $attribute)
                                @php $attributeCheck = in_array($attribute->id, $product->attributes->pluck('attribute_id')->toArray()) @endphp
                                @if ($attributeCheck)
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'ar' && $attribute->name_ar ? $attribute->name_ar : $attribute->name }}:</label>
                                        <div class="d-flex flex-wrap justify-content-start align-items-start">
                                            @foreach ($product->attributes as $attributeValue)
                                                @if ($attributeValue->attribute_id == $attribute->id)
                                                    <div class="form-check form-check-inline attribute-option me-1 mb-1">
                                                        <input class="form-check-input d-none attribute-radio" type="radio" 
                                                            name="{{ strtolower($attribute->name) }}" 
                                                            id="attribute-{{ $attributeValue->id }}" 
                                                            value="{{ $attributeValue->value }}"
                                                            data-price="{{ floatval($attributeValue->price) }}"
                                                            {{ $loop->first ? 'checked' : '' }}>
                                                        <label class="form-check-label btn btn-outline-dark btn-sm {{ $loop->first ? 'active' : '' }}" 
                                                            for="attribute-{{ $attributeValue->id }}" 
                                                            style="padding: 0.25rem 0.75rem; font-size: 0.875rem;">
                                                            {{ ucwords($attributeValue->value) }}
                                                            @if ($attributeValue->price != null && $attributeValue->price > 0)
                                                                +{{ config('settings.currency_symbol.value') }}{{ number_format($attributeValue->price) }}
                                                            @endif
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif

                        {{-- Quantity --}}
                        <div class="form-group mb-3">
                            <label class="form-label fw-semibold">{{ __('Quantity') }}:</label>
                            <input class="form-control form-control-md" type="number" min="1" value="1" max="{{ $product->qty }}" name="qty" id="qty" style="max-width: 150px;">
                        </div>

                        <hr>

                        {{-- Action Buttons --}}
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-shopping-cart"></i> {{ __('Add To Cart') }}
                            </button>
                            <a href="{{ route('products.order-now', $product->slug) }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-bolt"></i> {{ __('Buy Now') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="container my-5">
    <div class="additional-details text-center">
        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">{{ __('Description') }}</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">{{ __('Reviews') }}</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="specifications-tab" data-bs-toggle="tab" data-bs-target="#specifications" type="button" role="tab" aria-controls="specifications" aria-selected="false">{{ __('Specifications') }}</button>
            </li>
        </ul>
        <div class="tab-content mt-4 mb-3 card shadow-sm border-0 p-3 text-start" id="myTabContent">
            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                {!! app()->getLocale() == 'ar' && $product->description_ar ? $product->description_ar : $product->description !!}
                <h5 class="mt-3">{{ __('Details') }}</h5>
                {!! app()->getLocale() == 'ar' && $product->details_ar ? $product->details_ar : $product->details !!}
            </div>
            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                <h4 class="mb-3">{{ __('Customer Reviews') }}</h4>
                @livewire('product-ratings', ['product' => $product])
                @livewire('rate-form', ['product' => $product])
            </div>
            <div class="tab-pane fade" id="specifications" role="tabpanel" aria-labelledby="specifications-tab">
                <h4 class="mb-3">{{ __('Product Specifications') }}</h4>
                @if ($product->attributes->isNotEmpty())
                    <ul class="list-group list-group-flush">
                        @php
                            $groupedAttributes = $product->attributes->groupBy('attribute.name');
                        @endphp
                        @foreach ($groupedAttributes as $attributeName => $attributes)
                            <li class="list-group-item d-flex justify-content-between align-items-center ps-0 pe-0">
                                <span class="fw-bold">{{ $attributeName }}:</span>
                                <span>
                                    @foreach ($attributes as $attribute)
                                        {{ $attribute->value }}{{ !$loop->last ? ', ' : '' }}
                                    @endforeach
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">{{ __('No specifications available for this product.') }}</p>
                @endif
            </div>
        </div>
    </div>
</div> --}}

<div class="container pb-5">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-3">
                    <h4 class="mb-3">{{ __('Related Products') }}</h4>
                    <div class="row g-3">
                        @php
                            $relatedProducts = $product->categories()?->first()?->products()->limit(8)->get()->except($product->id);
                        @endphp

                        @forelse ($relatedProducts as $related_product)
                            <div class="col-md-3 col-6">
                                @include('site.partials.related_products', ['related_product' => $related_product])
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-muted">{{ __('No related products found.') }}</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Mobile: Display thumbnails horizontally below big image */
    @media (max-width: 767.98px) {
        .mini-preview {
            display: flex;
            flex-direction: row;
            gap: 10px;
            overflow-x: auto;
            padding: 10px 0;
            justify-content: flex-start;
            -webkit-overflow-scrolling: touch;
            scroll-snap-type: x mandatory;
        }
        
        .mini-preview img {
            flex-shrink: 0;
            width: 80px;
            height: 80px;
            object-fit: cover;
            scroll-snap-align: start;
            margin-bottom: 0 !important;
        }
        
        .product-image-display {
            margin-bottom: 15px;
        }
    }
    
    /* Desktop: Keep thumbnails vertical on the left */
    @media (min-width: 768px) {
        .mini-preview {
            display: flex;
            flex-direction: column;
        }
        
        .mini-preview img {
            width: 100%;
            cursor: pointer;
        }
    }

    .cursor-pointer {
        cursor: pointer;
    }

    .theme-text {
        color: hsl(353, 100%, 78%);
    }

    .attribute-option label.active {
        background-color: hsl(353, 100%, 78%) !important;
        color: white !important;
        border-color: hsl(353, 100%, 78%) !important;
    }

    .attribute-option label:hover {
        border-color: hsl(353, 100%, 78%);
    }
</style>
@endsection

@push('scripts')
<script>
    // Image gallery functionality
    const miniPreviewImages = document.querySelectorAll('.mini-preview img');
    const mainProductImage = document.getElementById('mainProductImage');

    if (miniPreviewImages.length > 0 && mainProductImage) {
        miniPreviewImages.forEach((imgItem) => {
            imgItem.addEventListener('click', (event) => {
                event.preventDefault();
                mainProductImage.src = imgItem.src;
                miniPreviewImages.forEach(img => img.classList.remove('border-primary'));
                imgItem.classList.add('border-primary');
            });
        });
    }

    // Attribute selection styling
    document.querySelectorAll('.attribute-option input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const attributeId = this.name;
            document.querySelectorAll(`input[name="${attributeId}"]`).forEach(otherRadio => {
                otherRadio.nextElementSibling.classList.remove('active');
            });
            this.nextElementSibling.classList.add('active');
            calculatePrice();
        });
    });

    // Price calculation function
    function calculatePrice() {
        let basePrice = parseFloat('{{ $product->sale_price ?: $product->unit_price }}');
        let totalPrice = basePrice;

        // Calculate additional price from selected attributes
        document.querySelectorAll('.attribute-radio:checked').forEach(function(radio) {
            const price = parseFloat(radio.dataset.price) || 0;
            totalPrice += price;
        });

        // Update displayed price
        const priceElement = document.getElementById('productPrice');
        if (priceElement) {
            const formattedPrice = Math.round(totalPrice).toLocaleString();
            priceElement.innerHTML = '{{ config("settings.currency_symbol.value") }}' + formattedPrice;
            
            // If there's a sale price, update the strike-through price display
            @if($product->sale_price > 0)
            const originalPriceElement = document.querySelector('.original-price');
            if (originalPriceElement && totalPrice > basePrice) {
                // If attributes add price, show updated original price
                const originalBasePrice = parseFloat('{{ $product->unit_price }}');
                const priceDiff = totalPrice - basePrice;
                originalPriceElement.textContent = '{{ config("settings.currency_symbol.value") }}' + Math.round(originalBasePrice + priceDiff).toLocaleString();
            }
            @endif
        }

        // Update hidden price input
        const finalPriceInput = document.getElementById('finalPrice');
        if (finalPriceInput) {
            finalPriceInput.value = totalPrice.toFixed(2);
        }
    }

    // Initialize price calculation on page load
    $(document).ready(function() {
        calculatePrice();

        $('#addToCart').submit(function(e) {
            calculatePrice();
            // Form will submit with correct price
        });

        // Recalculate price when quantity changes
        $('#qty').on('change input', function() {
            // Quantity doesn't affect unit price calculation, but you might want to show total
        });
    });

    // Add hover effect for related product cards
    document.querySelectorAll('.related-product-card').forEach(card => {
        card.addEventListener('mouseover', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 .5rem 1rem rgba(0,0,0,.15)';
        });
        card.addEventListener('mouseout', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 .125rem .25rem rgba(0,0,0,.075)';
        });
    });
</script>
@endpush
