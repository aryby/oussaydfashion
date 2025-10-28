<div class="overlay" data-overlay></div>

<!--
      - MODAL
    -->

{{-- <div class="modal" data-modal>

    <div class="modal-close-overlay" data-modal-overlay></div>

    <div class="modal-content">

        <button class="modal-close-btn" data-modal-close>
            <ion-icon name="close-outline"></ion-icon>
        </button>

        <div class="newsletter-img">
            <img src="./assets/images/newsletter.png" alt="subscribe newsletter" width="400" height="400">
        </div>

        <div class="newsletter">

            <form action="#">

                <div class="newsletter-header">

                    <h3 class="newsletter-title">Subscribe Newsletter.</h3>

                    <p class="newsletter-desc">
                        Subscribe the <b>Anon</b> to get latest products and discount update.
                    </p>

                </div>

                <input type="email" name="email" class="email-field" placeholder="Email Address" required>

                <button type="submit" class="btn-newsletter">Subscribe</button>

            </form>

        </div>

    </div>

</div>
 --}}




<!--
    - NOTIFICATION TOAST
  -->

{{-- <div class="notification-toast" data-toast>

    <button class="toast-close-btn" data-toast-close>
        <ion-icon name="close-outline"></ion-icon>
    </button>

    <div class="toast-banner">
        <img src="./assets/images/products/jewellery-1.jpg" alt="Rose Gold Earrings" width="80" height="70">
    </div>

    <div class="toast-detail">

        <p class="toast-message">
            Someone in new just bought
        </p>

        <p class="toast-title">
            Rose Gold Earrings
        </p>

        <p class="toast-meta">
            <time datetime="PT2M">2 Minutes</time> ago
        </p>

    </div>

</div> --}}

<header>

    <div class="header-top">

        <div class="container">

            <ul class="header-social-container">

                <li>
                    <a href="#" class="social-link">
                        <ion-icon name="logo-facebook"></ion-icon>
                    </a>
                </li>

                <li>
                    <a href="#" class="social-link">
                        <ion-icon name="logo-twitter"></ion-icon>
                    </a>
                </li>

                <li>
                    <a href="#" class="social-link">
                        <ion-icon name="logo-instagram"></ion-icon>
                    </a>
                </li>

                <li>
                    <a href="#" class="social-link">
                        <ion-icon name="logo-linkedin"></ion-icon>
                    </a>
                </li>

            </ul>

            <div class="header-alert-news">
                <p>
                    <b>Free Shipping</b>
                    This Week Order Over - $55
                </p>
            </div>

            <div class="header-top-actions">

                <button class="btn dropdown-toggle" style="border :none; text-transform :uppercase;" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ config('languages.' . app()->getLocale()) ?? config('languages.' . config('app.fallback_locale')) }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @foreach (config('languages') as $locale => $lang)
                            <a class="dropdown-item"
                                href="{{ route('langswitcher', ['locale' => $locale]) }}">{{ $lang }}</a>
                        @endforeach
                    </div>
            </div>

        </div>

    </div>

    <div class="header-main">

        <div class="container">

            <a href="#" class="header-logo">
                <img src="{{ asset('inspire/assets/images/logo/logo.jpg') }}" alt="Anon's logo" width="120" height="36">
            </a>

            <div class="header-search-container">

                <form action="{{ route('products.search') }}" class="search-wrap">
                    

                    <input type="text" class="search-field" placeholder="{{ __('Search Products') }}" name="q"
                        value="{{ isset($q) ? $q : '' }}">
                    <button class="search-btn" type="submit">
                        <ion-icon name="search-outline"></ion-icon>
                    </button>
                </form>
            </div>

            <div class="header-user-actions">

                {{-- <button class="action-btn">
                    <ion-icon name="person-outline"></ion-icon>
                </button> --}}

                {{-- <button class="action-btn">
                    <ion-icon name="heart-outline"></ion-icon>
                    <span class="count">0</span>
                </button>

                <button class="action-btn">
                    <ion-icon name="bag-handle-outline"></ion-icon>
                    <span class="count">0</span>
                </button> --}}

                {{-- her --}}
                <div class="widgets-wrap d-flex justify-content-end">
                        @auth
                            @include('site.partials.cart_widget')
                        @endauth
                        @include('site.partials.user_widget')
                    </div>
            </div>

        </div>

    </div>
    @include('site.partials.nav')
{{-- 
    <nav class="desktop-navigation-menu">

        <div class="container">

            <ul class="desktop-menu-category-list">

                <li class="menu-category">
                    <a href="#" class="menu-title">Home</a>
                </li>

                <li class="menu-category">
                    <a href="#" class="menu-title">Categories</a>

                    <div class="dropdown-panel">

                        <ul class="dropdown-panel-list">

                            <li class="menu-title">
                                <a href="#">Electronics</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Desktop</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Laptop</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Camera</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Tablet</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Headphone</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">
                                    <img src="./assets/images/electronics-banner-1.jpg" alt="headphone collection"
                                        width="250" height="119">
                                </a>
                            </li>

                        </ul>

                        <ul class="dropdown-panel-list">

                            <li class="menu-title">
                                <a href="#">Men's</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Formal</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Casual</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Sports</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Jacket</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Sunglasses</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">
                                    <img src="./assets/images/mens-banner.jpg" alt="men's fashion" width="250"
                                        height="119">
                                </a>
                            </li>

                        </ul>

                        <ul class="dropdown-panel-list">

                            <li class="menu-title">
                                <a href="#">Women's</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Formal</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Casual</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Perfume</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Cosmetics</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Bags</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">
                                    <img src="./assets/images/womens-banner.jpg" alt="women's fashion" width="250"
                                        height="119">
                                </a>
                            </li>

                        </ul>

                        <ul class="dropdown-panel-list">

                            <li class="menu-title">
                                <a href="#">Electronics</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Smart Watch</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Smart TV</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Keyboard</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Mouse</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Microphone</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">
                                    <img src="./assets/images/electronics-banner-2.jpg" alt="mouse collection"
                                        width="250" height="119">
                                </a>
                            </li>

                        </ul>

                    </div>
                </li>

                <li class="menu-category">
                    <a href="#" class="menu-title">Men's</a>

                    <ul class="dropdown-list">

                        <li class="dropdown-item">
                            <a href="#">Shirt</a>
                        </li>

                        <li class="dropdown-item">
                            <a href="#">Shorts & Jeans</a>
                        </li>

                        <li class="dropdown-item">
                            <a href="#">Safety Shoes</a>
                        </li>

                        <li class="dropdown-item">
                            <a href="#">Wallet</a>
                        </li>

                    </ul>
                </li>

                <li class="menu-category">
                    <a href="#" class="menu-title">Women's</a>

                    <ul class="dropdown-list">

                        <li class="dropdown-item">
                            <a href="#">Dress & Frock</a>
                        </li>

                        <li class="dropdown-item">
                            <a href="#">Earrings</a>
                        </li>

                        <li class="dropdown-item">
                            <a href="#">Necklace</a>
                        </li>

                        <li class="dropdown-item">
                            <a href="#">Makeup Kit</a>
                        </li>

                    </ul>
                </li>

                <li class="menu-category">
                    <a href="#" class="menu-title">Jewelry</a>

                    <ul class="dropdown-list">

                        <li class="dropdown-item">
                            <a href="#">Earrings</a>
                        </li>

                        <li class="dropdown-item">
                            <a href="#">Couple Rings</a>
                        </li>

                        <li class="dropdown-item">
                            <a href="#">Necklace</a>
                        </li>

                        <li class="dropdown-item">
                            <a href="#">Bracelets</a>
                        </li>

                    </ul>
                </li>

                <li class="menu-category">
                    <a href="#" class="menu-title">Perfume</a>

                    <ul class="dropdown-list">

                        <li class="dropdown-item">
                            <a href="#">Clothes Perfume</a>
                        </li>

                        <li class="dropdown-item">
                            <a href="#">Deodorant</a>
                        </li>

                        <li class="dropdown-item">
                            <a href="#">Flower Fragrance</a>
                        </li>

                        <li class="dropdown-item">
                            <a href="#">Air Freshener</a>
                        </li>

                    </ul>
                </li>

                <li class="menu-category">
                    <a href="#" class="menu-title">Blog</a>
                </li>

                <li class="menu-category">
                    <a href="#" class="menu-title">Hot Offers</a>
                </li>

            </ul>

        </div>

    </nav>

    <div class="mobile-bottom-navigation">

        <button class="action-btn" data-mobile-menu-open-btn>
            <ion-icon name="menu-outline"></ion-icon>
        </button>

        <button class="action-btn">
            <ion-icon name="bag-handle-outline"></ion-icon>

            <span class="count">0</span>
        </button>

        <button class="action-btn">
            <ion-icon name="home-outline"></ion-icon>
        </button>

        <button class="action-btn">
            <ion-icon name="heart-outline"></ion-icon>

            <span class="count">0</span>
        </button>

        <button class="action-btn" data-mobile-menu-open-btn>
            <ion-icon name="grid-outline"></ion-icon>
        </button>

    </div>

    <nav class="mobile-navigation-menu  has-scrollbar" data-mobile-menu>

        <div class="menu-top">
            <h2 class="menu-title">Menu</h2>

            <button class="menu-close-btn" data-mobile-menu-close-btn>
                <ion-icon name="close-outline"></ion-icon>
            </button>
        </div>

        <ul class="mobile-menu-category-list">

            <li class="menu-category">
                <a href="#" class="menu-title">Home</a>
            </li>

            <li class="menu-category">

                <button class="accordion-menu" data-accordion-btn>
                    <p class="menu-title">Men's</p>

                    <div>
                        <ion-icon name="add-outline" class="add-icon"></ion-icon>
                        <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                    </div>
                </button>

                <ul class="submenu-category-list" data-accordion>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Shirt</a>
                    </li>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Shorts & Jeans</a>
                    </li>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Safety Shoes</a>
                    </li>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Wallet</a>
                    </li>

                </ul>

            </li>

            <li class="menu-category">

                <button class="accordion-menu" data-accordion-btn>
                    <p class="menu-title">Women's</p>

                    <div>
                        <ion-icon name="add-outline" class="add-icon"></ion-icon>
                        <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                    </div>
                </button>

                <ul class="submenu-category-list" data-accordion>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Dress & Frock</a>
                    </li>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Earrings</a>
                    </li>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Necklace</a>
                    </li>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Makeup Kit</a>
                    </li>

                </ul>

            </li>

            <li class="menu-category">

                <button class="accordion-menu" data-accordion-btn>
                    <p class="menu-title">Jewelry</p>

                    <div>
                        <ion-icon name="add-outline" class="add-icon"></ion-icon>
                        <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                    </div>
                </button>

                <ul class="submenu-category-list" data-accordion>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Earrings</a>
                    </li>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Couple Rings</a>
                    </li>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Necklace</a>
                    </li>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Bracelets</a>
                    </li>

                </ul>

            </li>

            <li class="menu-category">

                <button class="accordion-menu" data-accordion-btn>
                    <p class="menu-title">Perfume</p>

                    <div>
                        <ion-icon name="add-outline" class="add-icon"></ion-icon>
                        <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                    </div>
                </button>

                <ul class="submenu-category-list" data-accordion>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Clothes Perfume</a>
                    </li>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Deodorant</a>
                    </li>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Flower Fragrance</a>
                    </li>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Air Freshener</a>
                    </li>

                </ul>

            </li>

            <li class="menu-category">
                <a href="#" class="menu-title">Blog</a>
            </li>

            <li class="menu-category">
                <a href="#" class="menu-title">Hot Offers</a>
            </li>

        </ul>

        <div class="menu-bottom">

            <ul class="menu-category-list">

                <li class="menu-category">

                    <button class="accordion-menu" data-accordion-btn>
                        <p class="menu-title">Language</p>

                        <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
                    </button>

                    <ul class="submenu-category-list" data-accordion>

                        <li class="submenu-category">
                            <a href="#" class="submenu-title">English</a>
                        </li>

                        <li class="submenu-category">
                            <a href="#" class="submenu-title">Espa&ntilde;ol</a>
                        </li>

                        <li class="submenu-category">
                            <a href="#" class="submenu-title">Fren&ccedil;h</a>
                        </li>

                    </ul>

                </li>

                <li class="menu-category">
                    <button class="accordion-menu" data-accordion-btn>
                        <p class="menu-title">Currency</p>
                        <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
                    </button>

                    <ul class="submenu-category-list" data-accordion>
                        <li class="submenu-category">
                            <a href="#" class="submenu-title">USD &dollar;</a>
                        </li>

                        <li class="submenu-category">
                            <a href="#" class="submenu-title">EUR &euro;</a>
                        </li>
                    </ul>
                </li>

            </ul>

            <ul class="menu-social-container">

                <li>
                    <a href="#" class="social-link">
                        <ion-icon name="logo-facebook"></ion-icon>
                    </a>
                </li>

                <li>
                    <a href="#" class="social-link">
                        <ion-icon name="logo-twitter"></ion-icon>
                    </a>
                </li>

                <li>
                    <a href="#" class="social-link">
                        <ion-icon name="logo-instagram"></ion-icon>
                    </a>
                </li>

                <li>
                    <a href="#" class="social-link">
                        <ion-icon name="logo-linkedin"></ion-icon>
                    </a>
                </li>

            </ul>

        </div>

    </nav>
 --}}
</header>










{{-- be here --}}
<header class="section-header">
    {{-- <section class="header-main">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <div class="brand-wrap">
                        @if (config('settings.site_logo.attachment') !== null)
                            <a href="{{ route('home') }}">
                                <img class="logo"
                                    src="{{ secure_asset('uploads/' . config('settings.site_logo.attachment')) }}">
                            </a>
                        @else
                            <a href="{{ route('home') }}" class="text-dark">
                                <h2 class="logo-text">{{ config('settings.site_title.value') }}</h2>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4">
                    <form action="{{ route('products.search') }}" class="search-wrap">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="{{ __('Search Products') }}"
                                name="q" value="{{ isset($q) ? $q : '' }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ config('languages.' . app()->getLocale()) ?? config('languages.' . config('app.fallback_locale')) }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @foreach (config('languages') as $locale => $lang)
                            <a class="dropdown-item"
                                href="{{ route('langswitcher', ['locale' => $locale]) }}">{{ $lang }}</a>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4">
                    <div class="widgets-wrap d-flex justify-content-end">
                        @auth
                            @include('site.partials.cart_widget')
                        @endauth
                        @include('site.partials.user_widget')
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    
</header>
