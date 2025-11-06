  <!--
    - custom js link
  -->
  <script src="{{ asset('inspire/assets/js/script.js') }}" type="text/javascript"></script>

  <!--
    - ionicon link
  -->
 
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<script type="text/javascript">
    /// some script

    (function() {
      function resetInspireOverlays() {
        var overlay = document.querySelector('.overlay');
        if (overlay) overlay.classList.remove('active');
        document.querySelectorAll('[data-mobile-menu]').forEach(function(el){
          el.classList.remove('active');
        });
      }
      document.addEventListener('DOMContentLoaded', resetInspireOverlays);
      if (window.Livewire) {
        document.addEventListener('livewire:navigated', resetInspireOverlays);
        document.addEventListener('livewire:load', function(){
          resetInspireOverlays();
        });
      }
    })();
</script>
  {{-- be here --}}



 
  <footer>

    <div class="footer-category">

      <div class="container">

        <h2 class="footer-category-title">{{ __('footer.brand_directory') }}</h2>

        <div class="footer-category-box">
          <h3 class="category-box-title">{{ __('footer.shop_by_category') }}</h3>
          <a href="{{ route('products.categories') }}" class="footer-category-link">{{ __('footer.all_categories') }}</a>
        </div>

      </div>

    </div>

    <div class="footer-nav">

      <div class="container">

        <ul class="footer-nav-list">

          <li class="footer-nav-item">
            <h2 class="nav-title">{{ __('footer.popular_categories') }}</h2>
          </li>
          @php
            $categories = App\Models\Category::where('menu', true)->get();
          @endphp
          @foreach($categories as $category)
            <li class="footer-nav-item">
              <a href="{{ route('categories.show', $category->slug) }}" class="footer-nav-link">{{ $category->name }}</a>
            </li>
          @endforeach

        </ul>

        <ul class="footer-nav-list">

          <li class="footer-nav-item">
            <h2 class="nav-title">{{ __('footer.products') }}</h2>
          </li>

          <li class="footer-nav-item">
            <a href="{{ route('products.prices_drop') }}" class="footer-nav-link">{{ __('footer.prices_drop') }}</a>
          </li>

          <li class="footer-nav-item">
            <a href="{{ route('products.new') }}" class="footer-nav-link">{{ __('footer.new_products') }}</a>
          </li>

          <li class="footer-nav-item">
            <a href="{{ route('products.bestsales') }}" class="footer-nav-link">{{ __('footer.best_sales') }}</a>
          </li>

          <li class="footer-nav-item">
            <a href="{{ route('contact.index') }}" class="footer-nav-link">{{ __('footer.contact_us') }}</a>
          </li>

          <li class="footer-nav-item">
            <a href="{{ route('sitemap.index') }}" class="footer-nav-link">{{ __('footer.sitemap') }}</a>
          </li>

        </ul>

        <ul class="footer-nav-list">

          <li class="footer-nav-item">
            <h2 class="nav-title">{{ __('footer.our_company') }}</h2>
          </li>

          <li class="footer-nav-item">
            <a href="{{ route('delivery.info') }}" class="footer-nav-link">{{ __('footer.delivery') }}</a>
          </li>

          <li class="footer-nav-item">
            <a href="{{ route('legal.notice') }}" class="footer-nav-link">{{ __('footer.legal_notice') }}</a>
          </li>

          <li class="footer-nav-item">
            <a href="{{ route('terms.conditions') }}" class="footer-nav-link">{{ __('footer.terms_conditions') }}</a>
          </li>

          <li class="footer-nav-item">
            <a href="{{ route('about.us') }}" class="footer-nav-link">{{ __('footer.about_us') }}</a>
          </li>

          <li class="footer-nav-item">
            <a href="{{ route('secure.payment') }}" class="footer-nav-link">{{ __('footer.secure_payment') }}</a>
          </li>

        </ul>

        <ul class="footer-nav-list">

          <li class="footer-nav-item">
            <h2 class="nav-title">{{ __('footer.services_title') }}</h2>
          </li>

          <li class="footer-nav-item">
            <a href="{{ route('services.returns') }}" class="footer-nav-link">{{ __('footer.returns_refunds') }}</a>
          </li>

          <li class="footer-nav-item">
            <a href="{{ route('services.faq') }}" class="footer-nav-link">{{ __('footer.faq') }}</a>
          </li>

          <li class="footer-nav-item">
            <a href="{{ route('services.shipping') }}" class="footer-nav-link">{{ __('footer.shipping_info') }}</a>
          </li>

          <li class="footer-nav-item">
            <a href="{{ route('services.warranty') }}" class="footer-nav-link">{{ __('footer.warranty') }}</a>
          </li>

          <li class="footer-nav-item">
            <a href="{{ route('services.gift_cards') }}" class="footer-nav-link">{{ __('footer.gift_cards') }}</a>
          </li>

        </ul>

        <ul class="footer-nav-list">

          <li class="footer-nav-item">
            <h2 class="nav-title">{{ __('Contact') }}</h2>
          </li>

          @if(config('settings.phone_enquiry.value'))
          <li class="footer-nav-item flex">
            <div class="icon-box">
              <ion-icon name="call-outline"></ion-icon>
            </div>

            <a href="tel:{{ config('settings.phone_enquiry.value') }}" class="footer-nav-link">{{ config('settings.phone_enquiry.value') }}</a>
          </li>
          @endif

        </ul>

        <ul class="footer-nav-list">

          <li class="footer-nav-item">
            <h2 class="nav-title">{{ __('Follow Us') }}</h2>
          </li>

          <li>
            <ul class="social-link">

              @if(config('settings.social_facebook.value'))
              <li class="footer-nav-item">
                <a href="{{ config('settings.social_facebook.value') }}" class="footer-nav-link" target="_blank" rel="noopener noreferrer">
                  <ion-icon name="logo-facebook"></ion-icon>
                </a>
              </li>
              @endif

              @if(config('settings.social_twitter.value'))
              <li class="footer-nav-item">
                <a href="{{ config('settings.social_twitter.value') }}" class="footer-nav-link" target="_blank" rel="noopener noreferrer">
                  <ion-icon name="logo-twitter"></ion-icon>
                </a>
              </li>
              @endif

              @if(config('settings.social_linkedin.value'))
              <li class="footer-nav-item">
                <a href="{{ config('settings.social_linkedin.value') }}" class="footer-nav-link" target="_blank" rel="noopener noreferrer">
                  <ion-icon name="logo-linkedin"></ion-icon>
                </a>
              </li>
              @endif

              @if(config('settings.social_instagram.value'))
              <li class="footer-nav-item">
                <a href="{{ config('settings.social_instagram.value') }}" class="footer-nav-link" target="_blank" rel="noopener noreferrer">
                  <ion-icon name="logo-instagram"></ion-icon>
                </a>
              </li>
              @endif

            </ul>
          </li>

        </ul>

      </div>

    </div>

    <div class="footer-bottom">

      <div class="container">
        <p class="copyright">
          Copyright &copy; {{ date('Y') }} <a href="/">{{ config('settings.site_title.value') ?: __('footer.store') }}</a> {{ __('footer.all_rights_reserved') }}
        </p>

      </div>

    </div>

  </footer>
