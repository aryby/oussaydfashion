@extends('site.app')
@section('title', __('Order Now'))
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">{{ __('Product Details') }}</div>
                <div class="card-body">
                    {{-- Product Image Gallery --}}
                    @if($product->images && count($product->images) > 0)
                        <div class="mb-3">
                            <img id="mainProductImage" src="{{ asset('uploads/' . $product->images[0]) }}" class="img-fluid rounded mb-2" alt="{{ $product->name }}" style="width: 100%; max-height: 400px; object-fit: contain;">
                            <div class="d-flex flex-wrap gallery-thumbs">
                                @foreach($product->images as $index => $image)
                                    <img src="{{ asset('uploads/' . $image) }}" class="img-thumbnail me-2 mb-2 {{ $loop->first ? 'border-primary' : '' }}" alt="{{ $product->name }} Thumbnail {{ $index + 1 }}" style="width: 60px; height: 60px; object-fit: cover; cursor: pointer;" onclick="changeMainImage(this)">
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @include('site.partials.product_details', ['product' => $product])
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-5">
            <div class="card">
                <div class="card-header bg-primary text-white">{{ __('Order Now') }} - {{ $product->name }}</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
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
                            <label>{{ __('Name') }}</label>
                            <input type="text" name="name" class="form-control" required value="{{ auth()->check() ? auth()->user()->first_name . ' ' . auth()->user()->last_name : '' }}">
                        </div>
                        <div class="form-group mb-3">
                            <label>{{ __('Email (optionnel)') }}</label>
                            <input type="email" name="email" class="form-control" value="{{ auth()->check() ? auth()->user()->email : '' }}">
                        </div>
                        <div class="form-group mb-3">
                            <label>{{ __('Phone') }}</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>{{ __('Address') }}</label>
                            <textarea name="address" class="form-control" required></textarea>
                        </div>

                        {{-- Product Attributes --}}
                        @if ($product->attributes->isNotEmpty())
                            <div class="form-group mb-3">
                                <label>{{ __('Select Attributes') }}</label>
                                @php
                                    $groupedAttributes = $product->attributes->groupBy('attribute.name');
                                @endphp
                                @foreach ($groupedAttributes as $attributeName => $attributes)
                                    <div class="mb-2">
                                        <strong>{{ $attributeName }}:</strong>
                                        @foreach ($attributes as $attribute)
                                            <div class="form-check form-check-inline attribute-option">
                                                <input class="form-check-input d-none" type="radio" name="attributes[{{ $attribute->attribute->id }}]"
                                                    id="attribute-{{ $attribute->id }}" value="{{ $attribute->id }}"
                                                    {{ $loop->first ? 'checked' : '' }}>
                                                <label class="form-check-label btn btn-outline-secondary {{ $loop->first ? 'active' : '' }}" for="attribute-{{ $attribute->id }}">
                                                    {{ $attribute->value }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="form-group mb-3">
                            <label>{{ __('Payment Method') }}</label>
                            <input type="text" class="form-control" value="Cash On Delivery" readonly>
                        </div>
                        <button type="submit" class="btn btn-success w-100">{{ __('Confirm Order') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function changeMainImage(thumbnail) {
        const mainImage = document.getElementById('mainProductImage');
        mainImage.src = thumbnail.src;

        // Remove border from previously selected thumbnail
        document.querySelectorAll('.gallery-thumbs .img-thumbnail').forEach(thumb => {
            thumb.classList.remove('border-primary');
        });

        // Add border to currently selected thumbnail
        thumbnail.classList.add('border-primary');
    }

    document.querySelectorAll('.attribute-option input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const attributeId = this.name;
            document.querySelectorAll(`input[name="${attributeId}"]`).forEach(otherRadio => {
                otherRadio.nextElementSibling.classList.remove('active');
            });
            this.nextElementSibling.classList.add('active');
        });
    });
</script>
@endpush
