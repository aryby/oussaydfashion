<!--
    - PRODUCT GRID
  -->
<section class="section-request bg padding-y-sm">
    <div class="container">
        <div class="row">
            
            <div class="product-main">

                <h2 class="title">New Products</h2>

                <div class="product-grid">
@foreach ($recently_added_products as $product)
                @include('site.partials.products')
            @endforeach
                    
                </div>

            </div>
        </div>
</section>
