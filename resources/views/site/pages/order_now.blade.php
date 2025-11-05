@extends('site.app')
@section('title', __('Order Now'))
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-7">
            {{-- Product Image Gallery and Details --}}
            <div class="card mb-3 shadow-sm border-0">
                <div class="card-body p-3">
                    @if($product->images && count($product->images) > 0)
                        <div class="row">
                            <div class="col-md-2 mini-preview">
                                @foreach($product->images as $index => $image)
                                    <img class="img-fluid mb-2 border p-1 rounded cursor-pointer {{ $loop->first ? 'border-primary' : '' }}" src="{{ asset('uploads/' . $image) }}" alt="Preview {{ $index + 1 }}" data-id="{{ $index + 1 }}">
                                @endforeach
                            </div>
                            <div class="col-md-10">
                                <div class="product-image-display">
                                    <img class="img-fluid rounded shadow-sm" src="{{ asset('uploads/' . $product->images[0]) }}" alt="Main Image" id="mainProductImageIdea" style="max-height: 500px; object-fit: contain;">
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="category text-muted small mb-1">{{ __('Category') }}: {{ $product->categories->first()->name ?? 'N/A' }}</div>
                    <h4 class="mb-2 fw-bold text-break">{{ $product->name }}</h4>
                    <div class="ratings my-2 d-flex align-items-center">
                        <div class="text-warning me-2">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i>
                        </div>
                        <div class="ml-2 text-muted small">(4.0) 10 Reviews</div>
                    </div>
                    <div class="product-price my-2 fs-4 fw-bold">
                        @if($product->sale_price > 0)
                            <span class="theme-text">{{ config('settings.currency_symbol.value') . $product->sale_price }}</span>
                            <strike class="original-price text-muted fs-6 fw-normal">{{ config('settings.currency_symbol.value') . $product->unit_price }}</strike>
                        @else
                            <span class="theme-text">{{ config('settings.currency_symbol.value') . $product->unit_price }}</span>
                        @endif
                    </div>
                    <div class="theme-text subtitle fw-bold mb-1">{{ __('Brief Description') }}:</div>
                    <div class="brief-description text-muted small mb-3">
                        {!! app()->getLocale() == 'ar' && $product->description_ar ? Str::limit($product->description_ar, 150) : Str::limit($product->description, 150) !!}
                    </div>
                    @include('site.partials.product_details', ['product' => $product])
                </div>
            </div>
        </div>
        <div class="col-md-5">
            {{-- Order Form --}}
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white text-dark text-center py-2 border-bottom">
                    <h5 class="mb-0">{{ __('Order Now') }}</h5>
                </div>
                <div class="card-body p-3">
                    @if ($errors->any())
                        <div class="alert alert-danger mb-3">
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
                            <label class="form-label fw-bold">{{ __('Name') }}</label>
                           
                            <input type="text" name="name" class="form-control form-control-md" required >
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label fw-semibold">{{ __('Email (optionnel)') }}</label>
                            <input type="email" name="email" class="form-control form-control-md" 
                            
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label fw-semibold">{{ __('Phone') }}</label>
                            <input type="text" name="phone" class="form-control form-control-md" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label fw-semibold">{{ __('Address') }}</label>
                            <textarea name="address" class="form-control form-control-md" required></textarea>
                        </div>

                        {{-- Product Attributes --}}
                        @if ($product->attributes->isNotEmpty())
                            <div class="form-group mb-1">
                                <label class="form-label fw-semibold">{{ __('Select Attributes') }}</label>
                                @php
                                    $groupedAttributes = $product->attributes->groupBy('attribute.name');
                                @endphp
                                @foreach ($groupedAttributes as $attributeName => $attributes)
                                    <div class="">
                                        <strong class="d-block fw-medium">{{ $attributeName }}:</strong>
                                        <hr>
                                        <div class="d-flex flex-wrap justify-content-start align-items-start">
                                            @foreach ($attributes as $attribute)
                                                <div class="form-check form-check-inline attribute-option me-1 mb-1">
                                                    <input class="form-check-input d-none" type="radio" name="attributes[{{ $attribute->attribute->id }}]"
                                                        id="attribute-{{ $attribute->id }}" value="{{ $attribute->id }}"
                                                        {{ $loop->first ? 'checked' : '' }}>
                                                    <label class="form-check-label btn btn-outline-dark btn-sm {{ $loop->first ? 'active' : '' }}" for="attribute-{{ $attribute->id }}" style="padding: 0.1rem 0.4rem; font-size: 0.75rem;">
                                                        {{ $attribute->value }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

             
                        <button type="submit" class="btn btn-primary w-100 mt-3">{{ __('Confirm Order') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
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
                <h4 class="mb-3">{{ __('Customer Reviews') }} - Test Content</h4>
                <p>This is a test to see if the reviews tab content changes.</p>
                {{-- @livewire('product-ratings', ['product' => $product]) --}}
                {{-- @livewire('rate-form', ['product' => $product]) --}}
            </div>
            <div class="tab-pane fade" id="specifications" role="tabpanel" aria-labelledby="specifications-tab">
                <h4 class="mb-3">{{ __('Product Specifications') }}</h4>
                <p class="text-muted">No specifications available for this product.</p>
                {{-- Product specifications will go here --}}
            </div>
        </div>
    </div>
</div>

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

@push('scripts')
<script>
    // Custom image gallery logic from idea file
    const miniPreviewImages = document.querySelectorAll('.mini-preview img');
    const mainProductImageIdea = document.getElementById('mainProductImageIdea');

    miniPreviewImages.forEach((imgItem) => {
        imgItem.addEventListener('click', (event) => {
            event.preventDefault();
            mainProductImageIdea.src = imgItem.src;
            miniPreviewImages.forEach(img => img.classList.remove('border-primary'));
            imgItem.classList.add('border-primary');
        });
    });

    document.querySelectorAll('.attribute-option input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const attributeId = this.name;
            document.querySelectorAll(`input[name="${attributeId}"]`).forEach(otherRadio => {
                otherRadio.nextElementSibling.classList.remove('active');
            });
            this.nextElementSibling.classList.add('active');
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
            this.style.boxShadow = '0 .125rem .25rem rgba(0,0,0,.075)'; // Reset to original shadow
        });
    });
</script>
@endpush
