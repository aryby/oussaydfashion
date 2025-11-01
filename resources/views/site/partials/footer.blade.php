  <!--
    - custom js link
  -->
  <script src="{{ secure_asset('inspire/assets/js/script.js') }}" type="text/javascript"></script>

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

        <h2 class="footer-category-title">Brand directory</h2>

        <div class="footer-category-box">
          <h3 class="category-box-title">Shop by Category :</h3>
          <a href="{{ route('products.categories') }}" class="footer-category-link">All Categories</a>
        </div>

      </div>

    </div>

    <div class="footer-nav">

      <div class="container">

        <ul class="footer-nav-list">

          <li class="footer-nav-item">
            <h2 class="nav-title">Popular Categories</h2>
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
            <h2 class="nav-title">Products</h2>
          </li>

          <li class="footer-nav-item">
            <a href="{{ route('products.prices_drop') }}" class="footer-nav-link">Prices drop</a>
          </li>

          <li class="footer-nav-item">
            <a href="{{ route('products.new') }}" class="footer-nav-link">New products</a>
          </li>

          <li class="footer-nav-item">
            <a href="{{ route('products.bestsales') }}" class="footer-nav-link">Best sales</a>
          </li>

          <li class="footer-nav-item">
            <a href="{{ route('contact.index') }}" class="footer-nav-link">Contact us</a>
          </li>

          <li class="footer-nav-item">
            <a href="{{ route('sitemap.index') }}" class="footer-nav-link">Sitemap</a>
          </li>

        </ul>

        <ul class="footer-nav-list">

          <li class="footer-nav-item">
            <h2 class="nav-title">Our Company</h2>
          </li>

          <li class="footer-nav-item">
            <a href="{{ route('delivery.info') }}" class="footer-nav-link">Delivery</a>
          </li>

          <li class="footer-nav-item">
            <a href="{{ route('legal.notice') }}" class="footer-nav-link">Legal Notice</a>
          </li>

          <li class="footer-nav-item">
            <a href="{{ route('terms.conditions') }}" class="footer-nav-link">Terms and conditions</a>
          </li>

          <li class="footer-nav-item">
            <a href="{{ route('about.us') }}" class="footer-nav-link">About us</a>
          </li>

          <li class="footer-nav-item">
            <a href="{{ route('secure.payment') }}" class="footer-nav-link">Secure payment</a>
          </li>

        </ul>

        <ul class="footer-nav-list">

          <li class="footer-nav-item">
            <h2 class="nav-title">Services</h2>
          </li>

          <li class="footer-nav-item">
            <a href="{{ route('services.returns') }}" class="footer-nav-link">Returns & Refunds</a>
          </li>

          <li class="footer-nav-item">
            <a href="{{ route('services.faq') }}" class="footer-nav-link">FAQ</a>
          </li>

          <li class="footer-nav-item">
            <a href="{{ route('services.shipping') }}" class="footer-nav-link">Shipping Info</a>
          </li>

          <li class="footer-nav-item">
            <a href="{{ route('services.warranty') }}" class="footer-nav-link">Warranty</a>
          </li>

          <li class="footer-nav-item">
            <a href="{{ route('services.gift_cards') }}" class="footer-nav-link">Gift Cards</a>
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
          Copyright &copy; {{ date('Y') }} <a href="/">{{ config('settings.site_title.value') ?: 'Store' }}</a> all rights reserved.
        </p>

      </div>

    </div>

  </footer>
