<div>
    <section class="section-pagetop bg-dark">
        <div class="container clearfix">
            <h2 class="title-page">{{ app()->getLocale() == 'ar' && $category->name_ar ? $category->name_ar : $category->name }}</h2>
        </div>
    </section>

    <div class="product-container">
        <div class="container">
            <div class="sidebar has-scrollbar" data-mobile-menu>
                <div class="card card-filter">
                    <article class="card-group-item">
                        <header class="card-header">
                            <a href="#" data-toggle="collapse" data-target="#collapse33">
                                <i class="icon-action fa fa-chevron-down"></i>
                                <h6 class="title">{{ __('Filter by price') }}</h6>
                            </a>
                        </header>
                        <div class="filter-content collapse show" id="collapse33">
                            <div class="card-body">
                                <div class="form-row">
                                    <form wire:submit="updatePrice" class="row-sm form-noborder">
                                        <div class="form-group col-md-6">
                                            <input wire:model="min_price" class="form-control border"
                                                placeholder="{{ __('min') }}" type="number" min="0"
                                                value="0">
                                            @error('min_price')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input wire:model="max_price" class="form-control border"
                                                placeholder="{{ __('max') }}" type="number" min="50"
                                                value="0">
                                            @error('max_price')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <input type="submit" value="{{ __('Apply') }}"
                                            class="btn btn-outline-primary center border" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </article>

                    <article class="card-group-item">
                        <header class="card-header">
                            <a href="#" data-toggle="collapse" data-target="#collapse44">
                                <i class="icon-action fa fa-chevron-down"></i>
                                <h6 class="title">{{ __('Filter by brand') }}</h6>
                            </a>
                        </header>
                        <div class="filter-content collapse show" id="collapse44">
                            <div class="card-body">
                                @foreach ($brands as $brand)
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" wire:click="updateBrand"
                                            wire:model="selected_brands" type="checkbox"
                                            value="{{ $brand->name }}" id="flexSwitchCheckDefault">
                                        <label class="form-check-label"
                                            for="flexSwitchCheckDefault">{{ $brand->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            <div class="product-box">
                <div class="product-main">
                    <h2 class="title">{{ app()->getLocale() == 'ar' && $category->name_ar ? $category->name_ar : $category->name }}</h2>
                    <div class="product-grid">
                        @forelse ($filtered_products as $product)
                            @include('site.partials.products')
                        @empty
                            <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">
                                <p style="font-size: 18px; color: #666;">{{ __('No products found') }}</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
