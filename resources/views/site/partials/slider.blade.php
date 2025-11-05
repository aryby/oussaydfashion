    <!--
      - BANNER
    -->

    <div class="banner">

      <div class="container">

        <div class="slider-container has-scrollbar">

          <div class="slider-item">

            <img src="{{ asset('inspire/assets/images/banner-1.jpg')}}" alt="women's latest fashion sale" class="banner-img">

            <div class="banner-content">

              <p class="banner-subtitle">Trending item</p>

              <h2 class="banner-title">Women's latest fashion sale</h2>

              <p class="banner-text">
                starting at &dollar; <b>20</b>.00
              </p>

              <a href="#" class="banner-btn">Shop now</a>

            </div>

          </div>

          <div class="slider-item">

            <img src="{{ asset('inspire/assets/images/banner-2.jpg')}}" alt="modern sunglasses" class="banner-img">

            <div class="banner-content">

              <p class="banner-subtitle">Trending accessories</p>

              <h2 class="banner-title">Modern sunglasses</h2>

              <p class="banner-text">
                starting at &dollar; <b>15</b>.00
              </p>

              <a href="#" class="banner-btn">Shop now</a>

            </div>

          </div>

          <div class="slider-item">

            <img src="{{ asset('inspire/assets/images/banner-3.jpg')}}" alt="new fashion summer sale" class="banner-img">

            <div class="banner-content">

              <p class="banner-subtitle">Sale Offer</p>

              <h2 class="banner-title">New fashion summer sale</h2>

              <p class="banner-text">
                starting at &dollar; <b>29</b>.99
              </p>

              <a href="#" class="banner-btn">Shop now</a>

            </div>

          </div>

        </div>

      </div>

    </div>



{{-- <section class="section-main bg padding-top-sm">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <!-- ================= main slide ================= -->
                <div class="owl-init slider-main owl-carousel" data-items="1" data-dots="false" data-nav="true">
                    @foreach ($offers as $offer)
                        <div class="item-slide">
                            <a href="{{ route('products.show', $offer->product?->slug) }}"><img
                                    src="{{ asset('uploads/' . $offer->image) }}"></a>
                        </div>
                    @endforeach
                </div>
                <!-- ============== main slidesow .end // ============= -->
            </div>
            <div class="col-md-3">
                @forelse ($featured_products as $product)
                    <div class="card mb-1">
                        <figure class="itemside">
                            @if ($product->images)
                                <div class="aside">
                                    <div class="img-wrap img-sm mt-3"><a
                                            href="{{ route('products.show', $product->slug) }}"><img
                                                src="{{ asset('uploads/' . $product->images[0]) }}"></a>
                                    </div>
                                </div>
                            @else
                                <div class="aside">
                                    <div class="img-wrap img-sm border-right"><a
                                            href="{{ ('assets\images\icons\rating-5.png') }}"><img
                                                src="{{ ('assets\images\icons\rating-5.png') }}"></a>
                                    </div>
                                </div>
                            @endif
                            <figcaption class="p-3">
                                <h6 class="title">
                                    <a class="text-dark"
                                        href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                                </h6>
                                @livewire('product-rating-wrap', ['product' => $product, 'inline' => true])
                                &nbsp;
                                @if ($product->offer?->discount_percentage)
                                    <span
                                        class="d-inline badge badge-success">{{ $product->offer?->discount_percentage . '% Discount' }}
                                    </span>
                                @endif
                                <div class="price-wrap mt-1">
                                    @if ($product->sale_price > 0)
                                        <span
                                            class="price-new b"><small><sup>{{ config('settings.currency_symbol.value') }}</sup></small>{{ $product->sale_price }}</span>
                                        <del class="price-old text-muted"><small><sup>{{ config('settings.currency_symbol.value') }}</sup></small>{{ $product->unit_price }}
                                        </del>
                                    @else
                                        <span
                                            class="price-new b"><small><sup>{{ config('settings.currency_symbol.value') }}</sup></small>{{ $product->unit_price }}</span>
                                    @endif
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
</section>
 --}}