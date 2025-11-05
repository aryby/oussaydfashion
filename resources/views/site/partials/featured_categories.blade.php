
    <!--
      - CATEGORY
    -->



{{-- here --}}
<section class="section-content padding-y-sm bg">
    <div class="container">
        <header class="section-heading heading-line">
            <h4 class="title-section bg">{{ __('Featured Categories') }}</h4>
        </header>
            <div class="category">

      <div class="container">

        <div class="category-item-container has-scrollbar">

            @forelse ($featured_categories as $category)
              <div class="category-item">

            <div class="category-img-box">
              <img src="{{ asset('uploads/' . $category->image) }}" alt="{{ $category->name }}" width="30">
            </div>

            <div class="category-content-box">

              <div class="category-content-flex">
                <h3 class="category-item-title">{{ $category->name }}</h3>

                <p class="category-item-amount">(53)</p>
              </div>

              <a href="{{ route('categories.show', $category->slug) }}" class="category-btn">Show all</a>

            </div>

          </div>

                {{-- <div class="col-md-4">
                    <div class="card-banner"
                        style="height:250px; background-image: url({{ asset('uploads/' . $category->image) }});">
                        <article class="overlay overlay-cover d-flex align-items-center justify-content-center">
                            <div class="text-center">
                                <h5 class="card-title">{{ $category->name }}</h5>
                                <a href="{{ route('categories.show', $category->slug) }}"
                                    class="btn btn-warning btn-sm"> {{ __('View Products') }}
                                </a>
                            </div>
                        </article>
                    </div>
                </div> --}}
            @empty
            @endforelse
        


        </div>

      </div>

    </div>
    </div>
</section>
