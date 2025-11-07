@extends('site.app')
@section('title', __('Order Now'))
@section('content')
@php
    use Illuminate\Support\Str;
    $isGuest = Auth::check() && Str::startsWith(Auth::user()->email, 'guest_');
    $isRealUser = Auth::check() && !Str::startsWith(Auth::user()->email, 'guest_');
@endphp

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
                                    <img class="img-fluid rounded shadow-sm" src="{{ asset('uploads/' . $product->images[0]) }}" alt="Main Image" id="mainProductImageIdea" style="max-height: 500px; object-fit: contain;">
                                </div>
                            </div>
                            <div class="col-12 col-md-2 mini-preview order-2 order-md-1">
                                @foreach($product->images as $index => $image)
                                    <img class="img-fluid mb-2 border p-1 rounded cursor-pointer {{ $loop->first ? 'border-primary' : '' }}" src="{{ asset('uploads/' . $image) }}" alt="Preview {{ $index + 1 }}" data-id="{{ $index + 1 }}">
                                @endforeach
                            </div>
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
                            <span class="theme-text">{{ config('settings.currency_symbol.value') }}{{ number_format($product->sale_price) }}</span>
                            <strike class="original-price text-muted fs-6 fw-normal">{{ config('settings.currency_symbol.value') }}{{ number_format($product->unit_price) }}</strike>
                        @else
                            <span class="theme-text">{{ config('settings.currency_symbol.value') }}{{ number_format($product->unit_price) }}</span>
                        @endif
                    </div>
                    @include('site.partials.product_details', ['product' => $product])
                </div>
            </div>
        </div>
        <div class="col-md-5">
            {{-- Order Form - Only for Guests --}}
            @if($isGuest || !Auth::check())
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white text-dark text-center py-2 border-bottom">
                        <h5 class="mb-0">{{ __('Order Now') }}</h5>
                    </div>
                    <div class="card-body p-3">
                        @if ($errors->any())
                            <div class="alert alert-danger mb-3">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('products.order-now.submit', $product->slug) }}" id="orderNowForm">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">{{ __('Name') }} <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control form-control-md" required 
                                    value="{{ Auth::check() ? Auth::user()->first_name . ' ' . Auth::user()->last_name : '' }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">{{ __('Email (optional)') }}</label>
                                <input type="email" name="email" class="form-control form-control-md" 
                                    value="{{ Auth::check() ? Auth::user()->email : '' }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">{{ __('Phone') }} <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control form-control-md" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">{{ __('Address') }} <span class="text-danger">*</span></label>
                                <textarea name="address" class="form-control form-control-md" required rows="3"></textarea>
                            </div>

                            {{-- Product Attributes --}}
                            @if ($product->attributes->isNotEmpty())
                                <div class="form-group mb-3">
                                    <label class="form-label fw-semibold">{{ __('Select Attributes') }}</label>
                                    @php
                                        $groupedAttributes = $product->attributes->groupBy('attribute.name');
                                    @endphp
                                    @foreach ($groupedAttributes as $attributeName => $attributes)
                                        <div class="mb-2">
                                            <strong class="d-block fw-medium mb-2">{{ $attributeName }}:</strong>
                                            <div class="d-flex flex-wrap justify-content-start align-items-start">
                                                @foreach ($attributes as $attribute)
                                                    <div class="form-check form-check-inline attribute-option me-1 mb-1">
                                                        <input class="form-check-input d-none" type="radio" name="attributes[{{ $attribute->attribute->id }}]"
                                                            id="attribute-{{ $attribute->id }}" value="{{ $attribute->id }}"
                                                            {{ $loop->first ? 'checked' : '' }}>
                                                        <label class="form-check-label btn btn-outline-dark btn-sm {{ $loop->first ? 'active' : '' }}" for="attribute-{{ $attribute->id }}" style="padding: 0.25rem 0.75rem; font-size: 0.875rem;">
                                                            {{ $attribute->value }}
                                                            @if ($attribute->price != null && $attribute->price > 0)
                                                                +{{ config('settings.currency_symbol.value') }}{{ number_format($attribute->price) }}
                                                            @endif
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <button type="submit" class="btn btn-primary w-100 mt-3 btn-lg">
                                <i class="fas fa-check"></i> {{ __('Confirm Order') }}
                            </button>
                        </form>
                    </div>
                </div>
            @else
                {{-- Real User - Just Confirm Button --}}
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white text-dark text-center py-2 border-bottom">
                        <h5 class="mb-0">{{ __('Confirm Checkout') }}</h5>
                    </div>
                    <div class="card-body p-3">
                        @if ($errors->any())
                            <div class="alert alert-danger mb-3">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- User Information Display --}}
                        @php
                            $userInfo = Auth::user()->info;
                            $hasAddress = $userInfo && (!empty($userInfo->city) || !empty($userInfo->state) || !empty($userInfo->country));
                        @endphp

                        @if(!$hasAddress)
                            <div class="alert alert-warning mb-3">
                                <i class="fas fa-exclamation-triangle"></i> 
                                {{ __('Please update your profile with address to complete checkout.') }}
                                <a href="{{ route('account.edit') }}" class="alert-link">{{ __('Update Profile') }}</a>
                            </div>
                        @endif

                        <div class="mb-3">
                            <div class="card bg-light border-0">
                                <div class="card-body p-3">
                                    <h6 class="fw-bold mb-3">{{ __('Your Information') }}</h6>
                                    <div class="mb-2">
                                        <strong>{{ __('Name') }}:</strong> 
                                        <span>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                                    </div>
                                    <div class="mb-2">
                                        <strong>{{ __('Email') }}:</strong> 
                                        <span>{{ Auth::user()->email }}</span>
                                    </div>
                                    @if($userInfo && !empty($userInfo->phone_number))
                                        <div class="mb-2">
                                            <strong>{{ __('Phone') }}:</strong> 
                                            <span>{{ $userInfo->phone_number }}</span>
                                        </div>
                                    @endif
                                    @if($hasAddress)
                                        <div class="mb-2">
                                            <strong>{{ __('Address') }}:</strong> 
                                            <span>
                                                {{ $userInfo ? (($userInfo->city ?? '') . ($userInfo->state ? ', ' . $userInfo->state : '') . ($userInfo->country ? ', ' . $userInfo->country : '')) : '' }}
                                            </span>
                                        </div>
                                    @else
                                        <div class="mb-2 text-danger">
                                            <strong>{{ __('Address') }}:</strong> 
                                            <span class="small">{{ __('Not provided') }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Product Attributes for Real User --}}
                        @if ($product->attributes->isNotEmpty())
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">{{ __('Select Attributes') }}</label>
                                @php
                                    $groupedAttributes = $product->attributes->groupBy('attribute.name');
                                @endphp
                                @foreach ($groupedAttributes as $attributeName => $attributes)
                                    <div class="mb-2">
                                        <strong class="d-block fw-medium mb-2">{{ $attributeName }}:</strong>
                                        <div class="d-flex flex-wrap justify-content-start align-items-start">
                                            @foreach ($attributes as $attribute)
                                                <div class="form-check form-check-inline attribute-option me-1 mb-1">
                                                    <input class="form-check-input d-none" type="radio" name="attributes[{{ $attribute->attribute->id }}]"
                                                        id="real-user-attribute-{{ $attribute->id }}" value="{{ $attribute->id }}"
                                                        {{ $loop->first ? 'checked' : '' }}>
                                                    <label class="form-check-label btn btn-outline-dark btn-sm {{ $loop->first ? 'active' : '' }}" for="real-user-attribute-{{ $attribute->id }}" style="padding: 0.25rem 0.75rem; font-size: 0.875rem;">
                                                        {{ $attribute->value }}
                                                        @if ($attribute->price != null && $attribute->price > 0)
                                                            +{{ config('settings.currency_symbol.value') }}{{ number_format($attribute->price) }}
                                                        @endif
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        {{-- Confirm Order Form for Real User --}}
                        <form method="POST" action="{{ route('products.order-now.submit', $product->slug) }}" id="realUserOrderForm">
                            @csrf
                            <input type="hidden" name="name" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}">
                            <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                            <input type="hidden" name="phone" value="{{ $userInfo && $userInfo->phone_number ? $userInfo->phone_number : '' }}" id="realUserPhone">
                            <input type="hidden" name="address" value="{{ $userInfo ? (($userInfo->city ?? '') . ($userInfo->state ? ', ' . $userInfo->state : '') . ($userInfo->country ? ', ' . $userInfo->country : '')) : '' }}" id="realUserAddress">
                            
                            <button type="submit" class="btn btn-primary w-100 mt-3 btn-lg" {{ !$hasAddress ? 'disabled' : '' }}>
                                <i class="fas fa-check-circle"></i> {{ __('Confirm Checkout') }}
                            </button>
                        </form>
                    </div>
                </div>
            @endif
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
        cursor: pointer;
    }
</style>
@endsection

@push('scripts')
<script>
    // Custom image gallery logic
    const miniPreviewImages = document.querySelectorAll('.mini-preview img');
    const mainProductImageIdea = document.getElementById('mainProductImageIdea');

    if (miniPreviewImages.length > 0 && mainProductImageIdea) {
        miniPreviewImages.forEach((imgItem) => {
            imgItem.addEventListener('click', (event) => {
                event.preventDefault();
                mainProductImageIdea.src = imgItem.src;
                miniPreviewImages.forEach(img => img.classList.remove('border-primary'));
                imgItem.classList.add('border-primary');
            });
        });
    }

    // Attribute selection styling for guest form
    document.querySelectorAll('.attribute-option input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const attributeId = this.name;
            document.querySelectorAll(`input[name="${attributeId}"]`).forEach(otherRadio => {
                otherRadio.nextElementSibling.classList.remove('active');
            });
            this.nextElementSibling.classList.add('active');
        });
    });

    // Real user form validation - ensure address is provided
    @if($isRealUser)
    document.getElementById('realUserOrderForm')?.addEventListener('submit', function(e) {
        const addressInput = document.getElementById('realUserAddress');
        
        if (!addressInput.value || addressInput.value.trim() === '') {
            e.preventDefault();
            alert('{{ __("Address is required. Please update your profile.") }}');
            window.location.href = '{{ route("account.edit") }}';
            return false;
        }
    });
    @endif

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
