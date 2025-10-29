<section class="section-content padding-y-sm bg">
    <div class="container">
        <div class="product-featured">

            <h2 class="title">{{ __('Featured Products') }}</h2>

            <div class="showcase-wrapper has-scrollbar">

                @foreach ($featured_products as $product)
                    @include('site.partials.featured')
                @endforeach


            </div>

        </div>
    </div>
</section>
